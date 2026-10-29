<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\ClassTermPublication;
use App\Models\Enrollment;
use App\Models\ResultPublicationAudit;
use App\Models\Section;
use App\Models\StudentFeeStatus;
use App\Models\StudentResult;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ClassTermResultPublicationController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'session_id' => [
                'nullable',
                'integer',
                'exists:academic_sessions,id',
            ],
            'section_id' => [
                'nullable',
                'integer',
                'exists:sections,id',
            ],
            'term' => [
                'nullable',
                Rule::in(StudentFeeStatus::TERMS),
            ],
        ]);

        $sessions = AcademicSession::orderByDesc('id')->get();

        $sections = Section::with('classLevel')
            ->where('is_active', true)
            ->get()
            ->sortBy(fn ($section) =>
                ($section->classLevel->sort_order ?? 0)
                . '-'
                . $section->name
            )
            ->values();

        $selectedSessionId = $validated['session_id'] ?? null;
        $selectedSectionId = $validated['section_id'] ?? null;
        $selectedTerm = $validated['term'] ?? 'First Term';

        $publication = null;
        $enrollments = collect();
        $requiredSubjects = collect();

        if ($selectedSessionId && $selectedSectionId) {
            $section = Section::with('classLevel.subjects')
                ->findOrFail($selectedSectionId);

            $requiredSubjects = $section->classLevel
                ->subjects()
                ->where('subjects.is_active', true)
                ->orderBy('subjects.name')
                ->get();

            $publication = ClassTermPublication::where(
                'academic_session_id',
                $selectedSessionId
            )
                ->where('section_id', $selectedSectionId)
                ->where('term', $selectedTerm)
                ->first();

            $enrollments = Enrollment::with([
                'student',
                'feeStatuses' => fn ($query) =>
                    $query->where('term', $selectedTerm),
                'studentResults' => fn ($query) =>
                    $query->where('term', $selectedTerm)
                        ->with('subject'),
            ])
                ->where('academic_session_id', $selectedSessionId)
                ->where('section_id', $selectedSectionId)
                ->where('enrollment_status', 'enrolled')
                ->whereHas('student', fn ($query) =>
                    $query->where('status', 'active')
                )
                ->get()
                ->sortBy(fn ($enrollment) =>
                    $enrollment->student->last_name
                    . ' '
                    . $enrollment->student->first_name
                )
                ->values();
        }

        return view('staff-management.class-term-publication', [
            'sessions' => $sessions,
            'sections' => $sections,
            'terms' => StudentFeeStatus::TERMS,
            'selectedSessionId' => $selectedSessionId,
            'selectedSectionId' => $selectedSectionId,
            'selectedTerm' => $selectedTerm,
            'publication' => $publication,
            'enrollments' => $enrollments,
            'requiredSubjects' => $requiredSubjects,
        ]);
    }

    public function publish(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'session_id' => [
                'required',
                'integer',
                'exists:academic_sessions,id',
            ],
            'section_id' => [
                'required',
                'integer',
                'exists:sections,id',
            ],
            'term' => [
                'required',
                Rule::in(StudentFeeStatus::TERMS),
            ],
        ]);

        $user = $request->user();

        abort_unless(
            $user
                && $user->role === 'super_admin'
                && $user->student_id === null,
            403
        );

        $section = Section::with('classLevel.subjects')
            ->findOrFail($validated['section_id']);

        $requiredSubjectIds = $section->classLevel
            ->subjects()
            ->where('subjects.is_active', true)
            ->pluck('subjects.id')
            ->map(fn ($id) => (int) $id)
            ->all();

        if (count($requiredSubjectIds) === 0) {
            return back()
                ->withInput()
                ->withErrors([
                    'publication' =>
                        'This class has no active subjects assigned. '
                        . 'Assign subjects before publishing results.',
                ]);
        }

        $sessionId = (int) $validated['session_id'];
        $sectionId = (int) $validated['section_id'];
        $term = $validated['term'];

        $counts = DB::transaction(function () use (
            $user,
            $sessionId,
            $sectionId,
            $term,
            $requiredSubjectIds
        ) {
            $publication = ClassTermPublication::where(
                'academic_session_id',
                $sessionId
            )
                ->where('section_id', $sectionId)
                ->where('term', $term)
                ->lockForUpdate()
                ->first();

            if (! $publication) {
                $publication = new ClassTermPublication([
                    'academic_session_id' => $sessionId,
                    'section_id' => $sectionId,
                    'term' => $term,
                ]);
            }

            $enrollments = Enrollment::with('student')
                ->where('academic_session_id', $sessionId)
                ->where('section_id', $sectionId)
                ->where('enrollment_status', 'enrolled')
                ->whereHas('student', fn ($query) =>
                    $query->where('status', 'active')
                )
                ->lockForUpdate()
                ->get();

            $eligibleEnrollmentIds = [];
            $excluded = [];

            foreach ($enrollments as $enrollment) {
                $reasons = [];

                $feeStatus = StudentFeeStatus::where(
                    'enrollment_id',
                    $enrollment->id
                )
                    ->where('term', $term)
                    ->value('status');

                if ($feeStatus !== StudentFeeStatus::PAID) {
                    $reasons[] = 'Fee status is not Paid';
                }

                $results = StudentResult::where(
                    'enrollment_id',
                    $enrollment->id
                )
                    ->where('term', $term)
                    ->whereIn('subject_id', $requiredSubjectIds)
                    ->get()
                    ->keyBy('subject_id');

                foreach ($requiredSubjectIds as $subjectId) {
                    $result = $results->get($subjectId);

                    if (! $result) {
                        $reasons[] = 'Missing a required subject result';
                        break;
                    }

                    if (
                        $result->status !== 'submitted'
                        || $result->first_assessment === null
                        || $result->second_assessment === null
                        || $result->exam === null
                    ) {
                        $reasons[] = 'One or more required scores are incomplete or not submitted';
                        break;
                    }
                }

                if ($reasons !== []) {
                    $excluded[] = [
                        'enrollment_id' => $enrollment->id,
                        'admission_number' =>
                            $enrollment->student->admission_number,
                        'reasons' => array_values(array_unique($reasons)),
                    ];

                    continue;
                }

                $eligibleEnrollmentIds[] = $enrollment->id;
            }

            /*
             * Reset the individual publication timestamps for this
             * class, session and term. Only eligible pupils receive
             * timestamps again below.
             */
            $classEnrollmentIds = $enrollments->pluck('id')->all();

            if ($classEnrollmentIds !== []) {
                StudentResult::whereIn(
                    'enrollment_id',
                    $classEnrollmentIds
                )
                    ->where('term', $term)
                    ->update(['published_at' => null]);
            }

            if ($eligibleEnrollmentIds !== []) {
                StudentResult::whereIn(
                    'enrollment_id',
                    $eligibleEnrollmentIds
                )
                    ->where('term', $term)
                    ->whereIn('subject_id', $requiredSubjectIds)
                    ->where('status', 'submitted')
                    ->whereNotNull('first_assessment')
                    ->whereNotNull('second_assessment')
                    ->whereNotNull('exam')
                    ->update(['published_at' => now()]);
            }

            $publication->is_published = true;
            $publication->published_by = $user->id;
            $publication->published_at = now();
            $publication->save();

            ResultPublicationAudit::create([
                'academic_session_id' => $sessionId,
                'section_id' => $sectionId,
                'term' => $term,
                'action' => 'published',
                'performed_by' => $user->id,
                'eligible_count' => count($eligibleEnrollmentIds),
                'excluded_count' => count($excluded),
                'details' => [
                    'eligible_enrollment_ids' =>
                        $eligibleEnrollmentIds,
                    'excluded_pupils' => $excluded,
                ],
            ]);

            return [
                'eligible' => count($eligibleEnrollmentIds),
                'excluded' => count($excluded),
            ];
        });

        return redirect()->route('staff-management.class-term-publication', [
            'session_id' => $sessionId,
            'section_id' => $sectionId,
            'term' => $term,
        ])->with(
            'success',
            'Publication completed. '
            . $counts['eligible']
            . ' eligible pupil(s); '
            . $counts['excluded']
            . ' excluded. Review the exclusion details before proceeding.'
        );
    }

    public function unpublish(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'session_id' => [
                'required',
                'integer',
                'exists:academic_sessions,id',
            ],
            'section_id' => [
                'required',
                'integer',
                'exists:sections,id',
            ],
            'term' => [
                'required',
                Rule::in(StudentFeeStatus::TERMS),
            ],
        ]);

        $user = $request->user();

        abort_unless(
            $user
                && $user->role === 'super_admin'
                && $user->student_id === null,
            403
        );

        DB::transaction(function () use ($validated, $user) {
            $publication = ClassTermPublication::where(
                'academic_session_id',
                $validated['session_id']
            )
                ->where('section_id', $validated['section_id'])
                ->where('term', $validated['term'])
                ->lockForUpdate()
                ->first();

            if ($publication) {
                $publication->is_published = false;
                $publication->published_by = $user->id;
                $publication->published_at = null;
                $publication->save();
            }

            $enrollmentIds = Enrollment::where(
                'academic_session_id',
                $validated['session_id']
            )
                ->where('section_id', $validated['section_id'])
                ->pluck('id');

            StudentResult::whereIn('enrollment_id', $enrollmentIds)
                ->where('term', $validated['term'])
                ->update(['published_at' => null]);

            ResultPublicationAudit::create([
                'academic_session_id' => $validated['session_id'],
                'section_id' => $validated['section_id'],
                'term' => $validated['term'],
                'action' => 'unpublished',
                'performed_by' => $user->id,
                'eligible_count' => 0,
                'excluded_count' => 0,
                'details' => [
                    'reason' => 'Super Admin unpublished the class and term.',
                ],
            ]);
        });

        return redirect()->route('staff-management.class-term-publication', [
            'session_id' => $validated['session_id'],
            'section_id' => $validated['section_id'],
            'term' => $validated['term'],
        ])->with(
            'success',
            'Results have been unpublished for the selected class and term.'
        );
    }
}