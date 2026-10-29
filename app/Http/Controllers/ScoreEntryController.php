<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Enrollment;
use App\Models\Section;
use App\Models\StudentResult;
use App\Models\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\ClassTermPublication;
use App\Models\ResultPublicationAudit;

class ScoreEntryController extends Controller
{
    private const TERMS = [
        'First Term',
        'Second Term',
        'Third Term',
    ];

    public function index(Request $request): View
    {
        $user = $request->user();

        $selectedTerm = $request->query('term', 'First Term');

        abort_unless(
            in_array($selectedTerm, self::TERMS, true),
            422,
            'Invalid academic term selected.'
        );

        $sectionsQuery = Section::query()
            ->where('is_active', true)
            ->with('classLevel')
            ->orderBy('class_level_id')
            ->orderBy('name');

        if ($user->role !== 'super_admin') {
            $sectionsQuery->whereIn(
                'id',
                $user->assignedSections()->select('sections.id')
            );
        }

        $sections = $sectionsQuery->get();

        $sessions = AcademicSession::orderByDesc('start_date')->get();

        $currentSession = AcademicSession::where('is_current', true)->first();

        $selectedSection = null;
        $selectedSession = null;
        $subjects = collect();
        $enrollments = collect();
        $selectedSubjectId = $request->integer('subject_id') ?: null;

        if ($request->filled('section_id') && $request->filled('session_id')) {
            $selectedSection = $sections->firstWhere(
                'id',
                $request->integer('section_id')
            );

            if (! $selectedSection) {
                abort(403, 'You are not assigned to this section.');
            }

            $selectedSession = $sessions->firstWhere(
                'id',
                $request->integer('session_id')
            );

            abort_unless($selectedSession, 404, 'Academic session not found.');

            $subjects = $selectedSection->classLevel
                ->subjects()
                ->where('subjects.is_active', true)
                ->orderBy('subjects.name')
                ->get();

            $enrollments = Enrollment::query()
                ->where('section_id', $selectedSection->id)
                ->where('academic_session_id', $selectedSession->id)
                ->where('enrollment_status', 'enrolled')
                ->with('student')
                ->orderBy('id')
                ->get();

            if (
                $selectedSubjectId &&
                ! $subjects->contains('id', $selectedSubjectId)
            ) {
                abort(403, 'This subject is not assigned to the selected class.');
            }

            if ($selectedSubjectId) {
                $existingResults = StudentResult::query()
                    ->whereIn('enrollment_id', $enrollments->pluck('id'))
                    ->where('subject_id', $selectedSubjectId)
                    ->where('term', $selectedTerm)
                    ->get()
                    ->keyBy('enrollment_id');

                $enrollments->each(function ($enrollment) use ($existingResults) {
                    $enrollment->result = $existingResults->get($enrollment->id);
                });
            }
        }

        return view('results.entry', [
            'sections' => $sections,
            'sessions' => $sessions,
            'currentSession' => $currentSession,
            'selectedSection' => $selectedSection,
            'selectedSession' => $selectedSession,
            'subjects' => $subjects,
            'enrollments' => $enrollments,
            'selectedSubjectId' => $selectedSubjectId,
            'selectedTerm' => $selectedTerm,
            'terms' => self::TERMS,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'section_id' => ['required', 'integer', 'exists:sections,id'],
            'session_id' => ['required', 'integer', 'exists:academic_sessions,id'],
            'term' => ['required', 'string', 'in:First Term,Second Term,Third Term'],
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
            'scores' => ['required', 'array', 'min:1'],
            'scores.*.first_assessment' => [
                'nullable', 'numeric', 'min:0', 'max:20',
            ],
            'scores.*.second_assessment' => [
                'nullable', 'numeric', 'min:0', 'max:20',
            ],
            'scores.*.exam' => [
                'nullable', 'numeric', 'min:0', 'max:60',
            ],
        ]);

        $section = Section::with('classLevel')->findOrFail(
            $validated['section_id']
        );

        if ($user->role !== 'super_admin') {
            $isAssigned = $user->assignedSections()
                ->where('sections.id', $section->id)
                ->exists();

            abort_unless(
                $isAssigned,
                403,
                'You are not assigned to this section.'
            );
        }

        $subject = Subject::query()
            ->where('is_active', true)
            ->whereKey($validated['subject_id'])
            ->firstOrFail();

        $subjectIsAssigned = $section->classLevel
            ->subjects()
            ->where('subjects.id', $subject->id)
            ->exists();

        abort_unless(
            $subjectIsAssigned,
            403,
            'This subject is not assigned to the selected class.'
        );

        $session = AcademicSession::findOrFail($validated['session_id']);

        $enrollmentIds = array_map(
            'intval',
            array_keys($validated['scores'])
        );

        $validEnrollmentIds = Enrollment::query()
            ->whereIn('id', $enrollmentIds)
            ->where('section_id', $section->id)
            ->where('academic_session_id', $session->id)
            ->where('enrollment_status', 'enrolled')
            ->pluck('id')
            ->map(fn ($id) => (int) $id)
            ->all();

        if (
            count($validEnrollmentIds) !==
            count(array_unique($enrollmentIds))
        ) {
            throw ValidationException::withMessages([
                'scores' => 'One or more pupils are not enrolled in this section for the selected session.',
            ]);
        }

        
        DB::transaction(function () use (
            $validated,
            $validEnrollmentIds,
            $user,
            $section,
            $session
        ) {
            $changedEnrollmentIds = [];

            foreach ($validEnrollmentIds as $enrollmentId) {
                $score = $validated['scores'][$enrollmentId];

                $first = $score['first_assessment'] ?? null;
                $second = $score['second_assessment'] ?? null;
                $exam = $score['exam'] ?? null;

                $hasAnyScore = $first !== null
                    || $second !== null
                    || $exam !== null;

                // Leave completely blank rows untouched.
                if (! $hasAnyScore) {
                    continue;
                }

                $allScoresEntered = $first !== null
                    && $second !== null
                    && $exam !== null;

                $result = StudentResult::query()
                    ->where('enrollment_id', $enrollmentId)
                    ->where('subject_id', $validated['subject_id'])
                    ->where('term', $validated['term'])
                    ->lockForUpdate()
                    ->first();

                $newValues = [
                    'first_assessment' => $first,
                    'second_assessment' => $second,
                    'exam' => $exam,
                    'entered_by' => $user->id,
                    'status' => $allScoresEntered ? 'submitted' : 'draft',
                ];

                // Compare scores and status before changing publication.
                $scoresActuallyChanged = ! $result
                    || (string) $result->first_assessment !== (string) $first
                    || (string) $result->second_assessment !== (string) $second
                    || (string) $result->exam !== (string) $exam
                    || $result->status !== $newValues['status'];

                if (! $result) {
                    $result = new StudentResult([
                        'enrollment_id' => $enrollmentId,
                        'subject_id' => $validated['subject_id'],
                        'term' => $validated['term'],
                    ]);
                }

                $result->fill($newValues);

                // Only a real score/status change clears this result's publication.
                if ($scoresActuallyChanged) {
                    $result->published_at = null;
                    $changedEnrollmentIds[] = $enrollmentId;
                }

                $result->save();
            }

            // If no scores or statuses changed, preserve the existing publication.
            if (empty($changedEnrollmentIds)) {
                return;
            }

            $term = $validated['term'];
            $now = now();

            // Revoke publication for this exact session, section and term.
            $publication = ClassTermPublication::query()
                ->where('academic_session_id', $session->id)
                ->where('section_id', $section->id)
                ->where('term', $term)
                ->lockForUpdate()
                ->first();

            if ($publication && $publication->is_published) {
                $publication->is_published = false;
                $publication->published_by = $user->id;
                $publication->published_at = null;
                $publication->save();

                // Clear published timestamps for every result in this class,
                // session and term, not just the edited pupil or subject.
                $classEnrollmentIds = Enrollment::query()
                    ->where('academic_session_id', $session->id)
                    ->where('section_id', $section->id)
                    ->pluck('id');

                StudentResult::query()
                    ->whereIn('enrollment_id', $classEnrollmentIds)
                    ->where('term', $term)
                    ->whereNotNull('published_at')
                    ->update([
                        'published_at' => null,
                        'updated_at' => $now,
                    ]);

                ResultPublicationAudit::create([
                    'academic_session_id' => $session->id,
                    'section_id' => $section->id,
                    'term' => $term,
                    'action' => 'revoked_due_to_score_change',
                    'performed_by' => $user->id,
                    'eligible_count' => 0,
                    'excluded_count' => 0,
                    'details' => [
                        'reason' => 'Scores or submission status changed after publication.',
                        'changed_enrollment_ids' => array_values(
                            array_unique($changedEnrollmentIds)
                        ),
                        'changed_subject_id' => (int) $validated['subject_id'],
                    ],
                ]);
            }
        });

        return redirect()
            ->route('results.entry', [
                'section_id' => $validated['section_id'],
                'session_id' => $validated['session_id'],
                'subject_id' => $validated['subject_id'],
                'term' => $validated['term'],
            ])
            ->with('success', 'Scores saved successfully.');
    }
}
