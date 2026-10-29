<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\ClassLevel;
use App\Models\Enrollment;
use App\Models\Section;
use App\Models\Student;
use App\Models\PupilProgressionAudit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class PupilProgressionController extends Controller
{
    /**
     * Display pupils and the available destination sessions and sections.
     */
    
    public function index(): View
    {
        $students = Student::query()
            ->with([
                'enrollments' => fn ($query) => $query
                    ->with(['academicSession', 'section.classLevel'])
                    ->orderByDesc('id'),
            ])
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(25);

        $studentsData = $students->getCollection()->map(
            function ($student) {
                return [
                    'id' => $student->id,
                    'enrollments' => $student->enrollments->map(
                        function ($enrolment) {
                            return [
                                'id' => $enrolment->id,
                                'session_id' => $enrolment->academic_session_id,
                                'session_name' => $enrolment->academicSession->name
                                    ?? 'Unknown session',
                                'class_name' => $enrolment->section->classLevel->name
                                    ?? 'Unknown class',
                                'section_name' => $enrolment->section->name
                                    ?? 'Unknown section',
                                'status' => $enrolment->enrollment_status,
                            ];
                        }
                    )->values(),
                ];
            }
        )->values();

        return view('pupil-progression.index', [
            'students' => $students,
            'studentsData' => $studentsData,
            'sessions' => AcademicSession::orderBy('start_date')->get(),
            'classLevels' => ClassLevel::where('is_active', true)
                ->with([
                    'sections' => fn ($query) => $query
                        ->where('is_active', true)
                        ->orderBy('name'),
                ])
                ->orderBy('sort_order')
                ->get(),
        ]);
    }


    /**
     * Promote, repeat, demote, or transfer a pupil.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => [
                'required',
                'integer',
                Rule::exists('students', 'id'),
            ],

            'source_enrollment_id' => [
                'required',
                'integer',
                Rule::exists('enrollments', 'id'),
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

            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        $message = DB::transaction(function () use ($validated, $request) {
            $student = Student::whereKey($validated['student_id'])
                ->lockForUpdate()
                ->firstOrFail();

            $source = Enrollment::whereKey(
                $validated['source_enrollment_id']
            )
                ->where('student_id', $student->id)
                ->with(['section.classLevel', 'academicSession'])
                ->lockForUpdate()
                ->firstOrFail();

            $destinationSession = AcademicSession::findOrFail(
                $validated['destination_session_id']
            );

            $destinationSection = Section::whereKey(
                $validated['destination_section_id']
            )
                ->where('is_active', true)
                ->with('classLevel')
                ->firstOrFail();

            $action = $validated['action'];

            if (! $destinationSection->classLevel ||
                ! $destinationSection->classLevel->is_active) {
                throw ValidationException::withMessages([
                    'destination_section_id' =>
                        'Choose a section belonging to an active class.',
                ]);
            }

            if ($source->enrollment_status !== 'enrolled') {
                throw ValidationException::withMessages([
                    'source_enrollment_id' =>
                        'Only a currently enrolled pupil can be progressed.',
                ]);
            }

            if ($action === 'transfer') {
                if ($destinationSession->id !== $source->academic_session_id) {
                    throw ValidationException::withMessages([
                        'destination_session_id' =>
                            'A transfer must stay within the same academic session. Use promotion, repetition, or demotion to move into another session.',
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
                            'This pupil already has result records. The transfer has been stopped to protect existing academic records. We will add a safe result-history transfer workflow next.',
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
                    'note' => $validated['note'] ?? null,
                    'performed_by' => $request->user()->id,
                ]);

                $source->update([
                    'section_id' => $destinationSection->id,
                ]);

                return 'Pupil transferred successfully. The movement was recorded in the audit trail.';
            }

            if ($destinationSession->id === $source->academic_session_id) {
                throw ValidationException::withMessages([
                    'destination_session_id' =>
                        'Promotion, repetition, and demotion require a different academic session.',
                ]);
            }

            if ($destinationSession->start_date &&
                $source->academicSession->start_date &&
                $destinationSession->start_date->lt(
                    $source->academicSession->start_date
                )) {
                throw ValidationException::withMessages([
                    'destination_session_id' =>
                        'Choose a later academic session.',
                ]);
            }

            $sourceOrder = $source->section->classLevel->sort_order;
            $destinationOrder = $destinationSection->classLevel->sort_order;

            if ($action === 'promote' &&
                $destinationOrder <= $sourceOrder) {
                throw ValidationException::withMessages([
                    'destination_section_id' =>
                        'Promotion requires a higher class level.',
                ]);
            }

            if ($action === 'repeat' &&
                $destinationOrder !== $sourceOrder) {
                throw ValidationException::withMessages([
                    'destination_section_id' =>
                        'Repetition requires the same class level.',
                ]);
            }

            if ($action === 'demote' &&
                $destinationOrder >= $sourceOrder) {
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
                        'This pupil already has an enrolment in the selected academic session. No duplicate enrolment was created.',
                ]);
            }

            $destinationEnrollment = Enrollment::create([
                'student_id' => $student->id,
                'academic_session_id' => $destinationSession->id,
                'section_id' => $destinationSection->id,
                'promotion_status' => $action === 'promote'
                    ? 'promoted'
                    : ($action === 'repeat' ? 'repeated' : 'demoted'),
                'enrollment_status' => 'enrolled',
            ]);

            $source->update([
                'promotion_status' => $action === 'promote'
                    ? 'promoted'
                    : ($action === 'repeat' ? 'repeated' : 'demoted'),
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
                'note' => $validated['note'] ?? null,
                'performed_by' => $request->user()->id,
            ]);
        });

        return redirect()
            ->route('pupil-progression.index')
            ->with('success', $message);
    }
}
