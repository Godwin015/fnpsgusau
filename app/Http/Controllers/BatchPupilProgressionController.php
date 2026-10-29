<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\ClassLevel;
use App\Models\Enrollment;
use App\Models\PupilProgressionAudit;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BatchPupilProgressionController extends Controller
{
    /**
     * Display the batch progression page.
     */
    public function index(): View
    {
        $sessions = AcademicSession::orderBy('start_date')->get();

        $classLevels = ClassLevel::where('is_active', true)
            ->with([
                'sections' => fn ($query) => $query
                    ->where('is_active', true)
                    ->orderBy('name'),
            ])
            ->orderBy('sort_order')
            ->get();

        return view('batch-pupil-progression.index', [
            'sessions' => $sessions,
            'classLevels' => $classLevels,
        ]);
    }

    /**
     * Load pupils belonging to the selected source session and section.
     */
    public function pupils(Request $request)
    {
        $validated = $request->validate([
            'source_session_id' => [
                'required',
                'integer',
                Rule::exists('academic_sessions', 'id'),
            ],

            'source_section_id' => [
                'required',
                'integer',
                Rule::exists('sections', 'id'),
            ],
        ]);

        $section = Section::with('classLevel')
            ->whereKey($validated['source_section_id'])
            ->where('is_active', true)
            ->firstOrFail();

        if (! $section->classLevel || ! $section->classLevel->is_active) {
            throw ValidationException::withMessages([
                'source_section_id' =>
                    'Choose a section belonging to an active class.',
            ]);
        }

        $enrollments = Enrollment::query()
            ->with('student')
            ->where('academic_session_id', $validated['source_session_id'])
            ->where('section_id', $section->id)
            ->where('enrollment_status', 'enrolled')
            ->whereHas('student')
            ->orderBy('id')
            ->get();

        return response()->json([
            'section' => [
                'id' => $section->id,
                'class_name' => $section->classLevel->name,
                'section_name' => $section->name,
            ],

            'pupils' => $enrollments->map(function ($enrollment) {
                $student = $enrollment->student;

                return [
                    'student_id' => $student->id,
                    'enrollment_id' => $enrollment->id,
                    'admission_number' => $student->admission_number,
                    'name' => trim(
                        $student->last_name . ', ' .
                        $student->first_name . ' ' .
                        ($student->middle_name ?? '')
                    ),
                ];
            })->values(),
        ]);
    }

    /**
     * Process a batch of pupil movements.
     *
     * Each pupil is processed in a separate transaction so one pupil's
     * failure does not roll back successful movements for other pupils.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'source_session_id' => [
                'required',
                'integer',
                Rule::exists('academic_sessions', 'id'),
            ],

            'source_section_id' => [
                'required',
                'integer',
                Rule::exists('sections', 'id'),
            ],

            'student_ids' => [
                'required',
                'array',
                'min:1',
                'max:500',
            ],

            'student_ids.*' => [
                'required',
                'integer',
                'distinct',
                Rule::exists('students', 'id'),
            ],

            'action' => [
                'required',
                Rule::in([
                    'promote',
                    'repeat',
                    'demote',
                    'transfer',
                ]),
            ],

            'destination_session_id' => [
                'required',
                'integer',
                Rule::exists('academic_sessions', 'id'),
            ],

            'destination_section_id' => [
                'required',
                'integer',
                Rule::exists('sections', 'id')->where('is_active', true),
            ],

            'note' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $results = [
            'success' => [],
            'failed' => [],
        ];

        foreach ($validated['student_ids'] as $studentId) {
            try {
                $this->processOne(
                    studentId: $studentId,
                    sourceSessionId: $validated['source_session_id'],
                    sourceSectionId: $validated['source_section_id'],
                    destinationSessionId: $validated['destination_session_id'],
                    destinationSectionId: $validated['destination_section_id'],
                    action: $validated['action'],
                    note: $validated['note'] ?? null,
                    performedBy: $request->user()->id,
                );

                $results['success'][] = $studentId;
            } catch (ValidationException $exception) {
                $results['failed'][] = [
                    'student_id' => $studentId,
                    'reason' => collect($exception->errors())
                        ->flatten()
                        ->first() ?? 'Movement validation failed.',
                ];
            } catch (\Throwable $exception) {
                report($exception);

                $results['failed'][] = [
                    'student_id' => $studentId,
                    'reason' => 'An unexpected error occurred. No movement was completed for this pupil.',
                ];
            }
        }

        $message = count($results['success']) .
            ' pupil movement(s) completed successfully.';

        if (count($results['failed']) > 0) {
            $message .= ' ' . count($results['failed']) .
                ' pupil movement(s) could not be completed.';
        }

        return redirect()
            ->route('batch-pupil-progression.index')
            ->with('batch_results', $results)
            ->with('success', $message);
    }

    /**
     * Process one pupil safely.
     */
    private function processOne(
        int $studentId,
        int $sourceSessionId,
        int $sourceSectionId,
        int $destinationSessionId,
        int $destinationSectionId,
        string $action,
        ?string $note,
        int $performedBy
    ): void {
        DB::transaction(function () use (
            $studentId,
            $sourceSessionId,
            $sourceSectionId,
            $destinationSessionId,
            $destinationSectionId,
            $action,
            $note,
            $performedBy
        ) {
            $student = Student::whereKey($studentId)
                ->lockForUpdate()
                ->firstOrFail();

            $source = Enrollment::where('student_id', $student->id)
                ->where('academic_session_id', $sourceSessionId)
                ->where('section_id', $sourceSectionId)
                ->with(['section.classLevel', 'academicSession'])
                ->lockForUpdate()
                ->first();

            if (! $source) {
                throw ValidationException::withMessages([
                    'student' =>
                        'The pupil does not have an enrolment in the selected source session and section.',
                ]);
            }

            if ($source->enrollment_status !== 'enrolled') {
                throw ValidationException::withMessages([
                    'student' =>
                        'The pupil is not currently enrolled in the selected source enrolment.',
                ]);
            }

            $destinationSession = AcademicSession::findOrFail(
                $destinationSessionId
            );

            $destinationSection = Section::whereKey($destinationSectionId)
                ->where('is_active', true)
                ->with('classLevel')
                ->first();

            if (
                ! $destinationSection ||
                ! $destinationSection->classLevel ||
                ! $destinationSection->classLevel->is_active
            ) {
                throw ValidationException::withMessages([
                    'destination_section_id' =>
                        'Choose a section belonging to an active class.',
                ]);
            }

            $sourceLevel = $source->section->classLevel;

            if (! $sourceLevel || ! $sourceLevel->is_active) {
                throw ValidationException::withMessages([
                    'source_section_id' =>
                        'The source enrolment does not belong to an active class.',
                ]);
            }

            /*
             * Transfer stays within the same academic session.
             */
            if ($action === 'transfer') {
                if ($destinationSession->id !== $source->academic_session_id) {
                    throw ValidationException::withMessages([
                        'destination_session_id' =>
                            'A transfer must stay within the same academic session.',
                    ]);
                }

                if ($destinationSection->id === $source->section_id) {
                    throw ValidationException::withMessages([
                        'destination_section_id' =>
                            'Choose a different destination section.',
                    ]);
                }

                if ($source->studentResults()->exists()) {
                    throw ValidationException::withMessages([
                        'action' =>
                            'This pupil already has result records. Transfer was stopped to protect academic records.',
                    ]);
                }

                PupilProgressionAudit::create([
                    'student_id' => $student->id,
                    'source_enrollment_id' => $source->id,
                    'destination_enrollment_id' => $source->id,
                    'source_session_id' => $source->academic_session_id,
                    'destination_session_id' => $destinationSession->id,
                    'source_section_id' => $source->section_id,
                    'destination_section_id' => $destinationSection->id,
                    'action' => 'transfer',
                    'note' => $note,
                    'performed_by' => $performedBy,
                ]);

                $source->update([
                    'section_id' => $destinationSection->id,
                ]);

                return;
            }

            /*
             * Promotion, repetition, and demotion create a new enrolment
             * in another academic session.
             */
            if ($destinationSession->id === $source->academic_session_id) {
                throw ValidationException::withMessages([
                    'destination_session_id' =>
                        'Promotion, repetition, and demotion require a different academic session.',
                ]);
            }

            if (
                $destinationSession->start_date &&
                $source->academicSession->start_date &&
                $destinationSession->start_date->lt(
                    $source->academicSession->start_date
                )
            ) {
                throw ValidationException::withMessages([
                    'destination_session_id' =>
                        'Choose a later academic session.',
                ]);
            }

            $sourceOrder = $sourceLevel->sort_order;
            $destinationOrder = $destinationSection->classLevel->sort_order;

            if ($action === 'promote' && $destinationOrder <= $sourceOrder) {
                throw ValidationException::withMessages([
                    'destination_section_id' =>
                        'Promotion requires a higher class level.',
                ]);
            }

            if ($action === 'repeat' && $destinationOrder !== $sourceOrder) {
                throw ValidationException::withMessages([
                    'destination_section_id' =>
                        'Repetition requires the same class level.',
                ]);
            }

            if ($action === 'demote' && $destinationOrder >= $sourceOrder) {
                throw ValidationException::withMessages([
                    'destination_section_id' =>
                        'Demotion requires a lower class level.',
                ]);
            }

            $alreadyEnrolled = Enrollment::where(
                'student_id',
                $student->id
            )
                ->where(
                    'academic_session_id',
                    $destinationSession->id
                )
                ->exists();

            if ($alreadyEnrolled) {
                throw ValidationException::withMessages([
                    'destination_session_id' =>
                        'The pupil already has an enrolment in the destination session.',
                ]);
            }

            $status = match ($action) {
                'promote' => 'promoted',
                'repeat' => 'repeated',
                'demote' => 'demoted',
            };

            $destinationEnrollment = Enrollment::create([
                'student_id' => $student->id,
                'academic_session_id' => $destinationSession->id,
                'section_id' => $destinationSection->id,
                'promotion_status' => $status,
                'enrollment_status' => 'enrolled',
            ]);

            $source->update([
                'promotion_status' => $status,
                'enrollment_status' => 'completed',
            ]);

            PupilProgressionAudit::create([
                'student_id' => $student->id,
                'source_enrollment_id' => $source->id,
                'destination_enrollment_id' => $destinationEnrollment->id,
                'source_session_id' => $source->academic_session_id,
                'destination_session_id' => $destinationSession->id,
                'source_section_id' => $source->section_id,
                'destination_section_id' => $destinationSection->id,
                'action' => $action,
                'note' => $note,
                'performed_by' => $performedBy,
            ]);
        });
    }
}
