<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Enrollment;
use App\Models\Section;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResultViewingController extends Controller
{
    private const TERMS = [
        'First Term',
        'Second Term',
        'Third Term',
    ];

    /**
     * Display available classes and academic sessions.
     *
     * Super Admin can access active and inactive sections.
     * Other staff can access only their assigned active sections.
     */
    public function classes(Request $request): View
    {
        $user = $request->user();

        $sectionsQuery = Section::query()
            ->with('classLevel')
            ->orderBy('class_level_id')
            ->orderBy('name');

        // Teachers and other staff retain the existing
        // active-section and assigned-section restrictions.
        if ($user->role !== 'super_admin') {
            $sectionsQuery
                ->where('is_active', true)
                ->whereIn(
                    'id',
                    $user->assignedSections()->select('sections.id')
                );
        }

        return view('results.classes', [
            'sections' => $sectionsQuery->get(),

            'sessions' => AcademicSession::orderByDesc('start_date')
                ->get(),

            'currentSession' => AcademicSession::where(
                'is_current',
                true
            )->first(),

            'terms' => self::TERMS,
        ]);
    }

    /**
     * Display pupils enrolled in a selected section and session.
     *
     * Super Admin can view completed historical enrollments.
     * Other staff can view only currently enrolled pupils.
     */
    public function students(Request $request, Section $section): View
    {
        $user = $request->user();

        // Preserve the existing staff assignment restriction.
        if ($user->role !== 'super_admin') {
            abort_unless(
                $section->is_active &&
                $user->assignedSections()
                    ->where('sections.id', $section->id)
                    ->exists(),
                403,
                'You are not assigned to this section.'
            );
        }

        $validated = $request->validate([
            'session_id' => [
                'required',
                'integer',
                'exists:academic_sessions,id',
            ],

            'term' => [
                'sometimes',
                'required',
                'string',
                'in:First Term,Second Term,Third Term',
            ],
        ]);

        $term = $validated['term'] ?? 'First Term';

        $session = AcademicSession::findOrFail(
            $validated['session_id']
        );

        $enrollmentsQuery = Enrollment::query()
            ->where('section_id', $section->id)
            ->where('academic_session_id', $session->id)
            ->with('student')
            ->orderBy('id');

        // Super Admin sees current and completed enrollments.
        // Teachers retain the current-enrollment restriction.
        if ($user->role === 'super_admin') {
            $enrollmentsQuery->whereIn(
                'enrollment_status',
                ['enrolled', 'completed']
            );
        } else {
            $enrollmentsQuery->where(
                'enrollment_status',
                'enrolled'
            );
        }

        $enrollments = $enrollmentsQuery->get();

        return view('results.students', [
            'section' => $section->load('classLevel'),

            'session' => $session,

            'enrollments' => $enrollments,

            'term' => $term,

            'terms' => self::TERMS,
        ]);
    }

    /**
     * Display a pupil's results for a selected session and term.
     *
     * Super Admin can view historical results.
     * Other staff must be assigned to the pupil's section.
     */
    public function studentResults(
        Request $request,
        Student $student
    ): View {
        $user = $request->user();

        $validated = $request->validate([
            'session_id' => [
                'required',
                'integer',
                'exists:academic_sessions,id',
            ],

            'term' => [
                'sometimes',
                'required',
                'string',
                'in:First Term,Second Term,Third Term',
            ],
        ]);

        $term = $validated['term'] ?? 'First Term';

        $session = AcademicSession::findOrFail(
            $validated['session_id']
        );

        $enrollment = Enrollment::query()
            ->where('student_id', $student->id)
            ->where('academic_session_id', $session->id)
            ->with([
                'section.classLevel',

                'studentResults' => function ($query) use ($term) {
                    $query
                        ->where('term', $term)
                        ->with('subject');
                },
            ])
            ->firstOrFail();

        // Preserve the existing staff assignment restriction.
        if ($user->role !== 'super_admin') {
            abort_unless(
                $user->assignedSections()
                    ->where('sections.id', $enrollment->section_id)
                    ->exists(),
                403,
                'You are not authorised to view this pupil’s results.'
            );
        }

        return view('results.student', [
            'student' => $student,

            'session' => $session,

            'term' => $term,

            'terms' => self::TERMS,

            'enrollment' => $enrollment,

            'results' => $enrollment->studentResults
                ->sortBy(
                    fn ($result) => $result->subject->name
                ),
        ]);
    }

    /**
     * Download a pupil's results as a PDF.
     *
     * Super Admin can download historical results.
     * Other staff must be assigned to the pupil's section.
     */
    public function downloadStudentResults(
        Request $request,
        Student $student
    ) {
        $user = $request->user();

        $validated = $request->validate([
            'session_id' => [
                'required',
                'integer',
                'exists:academic_sessions,id',
            ],

            'term' => [
                'sometimes',
                'required',
                'string',
                'in:First Term,Second Term,Third Term',
            ],
        ]);

        $term = $validated['term'] ?? 'First Term';

        $session = AcademicSession::findOrFail(
            $validated['session_id']
        );

        $enrollment = Enrollment::query()
            ->where('student_id', $student->id)
            ->where('academic_session_id', $session->id)
            ->with([
                'section.classLevel',

                'studentResults' => function ($query) use ($term) {
                    $query
                        ->where('term', $term)
                        ->with('subject');
                },
            ])
            ->firstOrFail();

        // Preserve the existing staff assignment restriction.
        if ($user->role !== 'super_admin') {
            abort_unless(
                $user->assignedSections()
                    ->where('sections.id', $enrollment->section_id)
                    ->exists(),
                403,
                'You are not authorised to download this pupil’s results.'
            );
        }

        $results = $enrollment->studentResults
            ->sortBy(
                fn ($result) => $result->subject->name
            );

        $pdf = Pdf::loadView('results.report-pdf', [
            'student' => $student,

            'session' => $session,

            'term' => $term,

            'enrollment' => $enrollment,

            'results' => $results,
        ])->setPaper('a4', 'portrait');

        $filename = 'FNPS-Result-'
            . preg_replace(
                '/[^A-Za-z0-9\_-]/',
                '-',
                $student->admission_number
            )
            . '-'
            . preg_replace(
                '/[^A-Za-z0-9\_-]/',
                '-',
                $session->name
            )
            . '-'
            . preg_replace(
                '/[^A-Za-z0-9\_-]/',
                '-',
                $term
            )
            . '.pdf';

        return $pdf->download($filename);
    }
}
