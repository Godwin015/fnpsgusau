<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Enrollment;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResultViewingController extends Controller
{
    /**
     * Show available sections to staff.
     */
    public function classes(Request $request): View
    {
        $user = $request->user();

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

        return view('results.classes', [
            'sections' => $sectionsQuery->get(),
            'sessions' => AcademicSession::orderByDesc('start_date')->get(),
            'currentSession' => AcademicSession::where('is_current', true)->first(),
        ]);
    }

    /**
     * Show pupils enrolled in a selected section and session.
     */
    public function students(Request $request, Section $section): View
    {
        $user = $request->user();

        if ($user->role !== 'super_admin') {
            abort_unless(
                $user->assignedSections()
                    ->where('sections.id', $section->id)
                    ->exists(),
                403,
                'You are not assigned to this section.'
            );
        }

        $validated = $request->validate([
            'session_id' => ['required', 'integer', 'exists:academic_sessions,id'],
        ]);

        $session = AcademicSession::findOrFail($validated['session_id']);

        $enrollments = Enrollment::query()
            ->where('section_id', $section->id)
            ->where('academic_session_id', $session->id)
            ->where('enrollment_status', 'enrolled')
            ->with('student')
            ->orderBy('id')
            ->get();

        return view('results.students', [
            'section' => $section->load('classLevel'),
            'session' => $session,
            'enrollments' => $enrollments,
        ]);
    }

    /**
     * Show results for one pupil, subject by subject.
     */
    public function studentResults(
        Request $request,
        Student $student
    ): View {
        $user = $request->user();

        $validated = $request->validate([
            'session_id' => ['required', 'integer', 'exists:academic_sessions,id'],
        ]);

        $session = AcademicSession::findOrFail($validated['session_id']);

        $enrollment = Enrollment::query()
            ->where('student_id', $student->id)
            ->where('academic_session_id', $session->id)
            ->with([
                'section.classLevel',
                'studentResults.subject',
            ])
            ->firstOrFail();

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
            'enrollment' => $enrollment,
            'results' => $enrollment->studentResults
                ->sortBy(fn ($result) => $result->subject->name),
        ]);
    }
}

