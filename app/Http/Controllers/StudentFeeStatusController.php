<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Enrollment;
use App\Models\FeeStatusAudit;
use App\Models\ClassTermPublication;
use App\Models\StudentResult;
use App\Models\Section;
use App\Models\StudentFeeStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StudentFeeStatusController extends Controller
{
    public function index(Request $request): View
    {
        $terms = StudentFeeStatus::TERMS;

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
                Rule::in($terms),
            ],
        ]);

        $sessions = AcademicSession::orderByDesc('id')->get();

        $sections = Section::with('classLevel')
            ->where('is_active', true)
            ->get()
            ->sortBy(fn ($section) =>
                $section->classLevel->sort_order . '-' . $section->name
            )
            ->values();

        $selectedSessionId = $validated['session_id'] ?? null;
        $selectedSectionId = $validated['section_id'] ?? null;
        $selectedTerm = $validated['term'] ?? 'First Term';

        $enrollments = collect();

        if ($selectedSessionId && $selectedSectionId) {
            $section = Section::with('classLevel')
                ->findOrFail($selectedSectionId);

            $enrollments = Enrollment::with([
                'student',
                'feeStatuses' => fn ($query) =>
                    $query->where('term', $selectedTerm),
            ])
                ->where('academic_session_id', $selectedSessionId)
                ->where('section_id', $section->id)
                ->whereIn('enrollment_status', ['active', 'enrolled'])
                ->whereHas('student', fn ($query) =>
                    $query->where('status', 'active')
                )
                ->get()
                ->sortBy(fn ($enrollment) =>
                    $enrollment->student->last_name . ' ' .
                    $enrollment->student->first_name
                )
                ->values();
        }

        return view('staff-management.fee-statuses', [
            'sessions' => $sessions,
            'sections' => $sections,
            'terms' => $terms,
            'enrollments' => $enrollments,
            'selectedSessionId' => $selectedSessionId,
            'selectedSectionId' => $selectedSectionId,
            'selectedTerm' => $selectedTerm,
        ]);
    }

    public function update(Request $request, Enrollment $enrollment): RedirectResponse
    {
        $validated = $request->validate([
            'term' => [
                'required',
                Rule::in(StudentFeeStatus::TERMS),
            ],
            'status' => [
                'required',
                Rule::in([
                    StudentFeeStatus::PAID,
                    StudentFeeStatus::NOT_PAID,
                ]),
            ],
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
        ]);

        abort_unless(
            $enrollment->academic_session_id === (int) $validated['session_id']
                && $enrollment->section_id === (int) $validated['section_id'],
            422,
            'The selected enrolment does not match the chosen session and section.'
        );

        $user = $request->user();

        abort_unless(
            $user && $user->role === 'super_admin' && $user->student_id === null,
            403,
            'Only the Super Admin can update pupil fee statuses.'
        );

        DB::transaction(function () use ($enrollment, $validated, $user) {
            $feeStatus = StudentFeeStatus::where(
                'enrollment_id',
                $enrollment->id
            )
                ->where('term', $validated['term'])
                ->lockForUpdate()
                ->first();

            $oldStatus = $feeStatus?->status;

            if ($oldStatus === $validated['status']) {
                return;
            }

            if (! $feeStatus) {
                $feeStatus = new StudentFeeStatus([
                    'enrollment_id' => $enrollment->id,
                    'term' => $validated['term'],
                ]);
            }

            $feeStatus->status = $validated['status'];
            $feeStatus->updated_by = $user->id;
            $feeStatus->save();

            FeeStatusAudit::create([
                'enrollment_id' => $enrollment->id,
                'term' => $validated['term'],
                'old_status' => $oldStatus,
                'new_status' => $validated['status'],
                'changed_by' => $user->id,
                'note' => 'Fee status updated through the Super Admin fee-management screen.',
            ]);


            /*
             * If this class/session/term has already been published,
             * make this pupil's results available when their fee becomes
             * Paid and all required active subjects have complete scores.
             */
            if ($validated['status'] === StudentFeeStatus::PAID) {
                $publication = ClassTermPublication::where(
                    'academic_session_id',
                    $enrollment->academic_session_id
                )
                    ->where('section_id', $enrollment->section_id)
                    ->where('term', $validated['term'])
                    ->where('is_published', true)
                    ->whereNotNull('published_at')
                    ->first();

                if ($publication) {
                    $section = Section::with('classLevel')
                        ->findOrFail($enrollment->section_id);

                    $requiredSubjectIds = $section->classLevel
                        ->subjects()
                        ->where('subjects.is_active', true)
                        ->pluck('subjects.id');

                    if ($requiredSubjectIds->isNotEmpty()) {
                        $results = StudentResult::where(
                            'enrollment_id',
                            $enrollment->id
                        )
                            ->where('term', $validated['term'])
                            ->whereIn('subject_id', $requiredSubjectIds)
                            ->where('status', 'submitted')
                            ->whereNotNull('first_assessment')
                            ->whereNotNull('second_assessment')
                            ->whereNotNull('exam')
                            ->get();

                        $completeSubjectIds = $results
                            ->pluck('subject_id')
                            ->unique();

                        if (
                            $completeSubjectIds->count()
                            === $requiredSubjectIds->unique()->count()
                        ) {
                            StudentResult::where(
                                'enrollment_id',
                                $enrollment->id
                            )
                                ->where('term', $validated['term'])
                                ->whereIn(
                                    'subject_id',
                                    $requiredSubjectIds
                                )
                                ->where('status', 'submitted')
                                ->whereNotNull('first_assessment')
                                ->whereNotNull('second_assessment')
                                ->whereNotNull('exam')
                                ->update([
                                    'published_at' => now(),
                                ]);
                        }
                    }
                }
            }

        });

        return redirect()->route('staff-management.fee-statuses', [
            'session_id' => $validated['session_id'],
            'section_id' => $validated['section_id'],
            'term' => $validated['term'],
        ])->with('success', 'Pupil fee status updated successfully.');
    }
}
