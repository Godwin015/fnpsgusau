<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\AcademicSession;
use App\Models\ClassTermPublication;
use App\Models\StudentFeeStatus;
use App\Models\StudentResult;
use Barryvdh\DomPDF\Facade\Pdf;

class ParentPortalController extends Controller
{
    public function showLogin(): View
    {
        return view('parent-portal.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'login_id' => ['required', 'string', 'max:100'],
            'pin' => ['required', 'digits:4'],
        ]);

        $key = 'parent-login:' . strtolower($validated['login_id'])
            . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            throw ValidationException::withMessages([
                'login_id' => 'Too many login attempts. Please try again in '
                    . RateLimiter::availableIn($key) . ' seconds.',
            ]);
        }

        if (! Auth::attempt([
            'login_id' => $validated['login_id'],
            'password' => $validated['pin'],
        ])) {
            RateLimiter::hit($key, 60);

            throw ValidationException::withMessages([
                'login_id' => 'The admission number or PIN is incorrect.',
            ]);
        }

        $request->session()->regenerate();
        RateLimiter::clear($key);

        if (Auth::user()->role !== 'student' || ! Auth::user()->student_id) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('parent.login')
                ->withErrors(['login_id' => 'This account is not linked to a pupil.']);
        }

        if (Auth::user()->must_change_pin) {
            return redirect()->route('parent.pin.edit');
        }

        return redirect()->route('parent.dashboard');
    }

    public function dashboard(): View
    {
        $student = Auth::user()->student()->with([
            'enrollments' => fn ($query) => $query
                ->with(['academicSession', 'section.classLevel'])
                ->orderByDesc('id'),
        ])->firstOrFail();

        return view('parent-portal.dashboard', compact('student'));
    }

   
    
    public function downloadResultsPdf(Request $request)
    {
        $validated = $request->validate([
            'session_id' => [
                'required',
                'integer',
                'exists:academic_sessions,id',
            ],
            'term' => [
                'required',
                'in:First Term,Second Term,Third Term',
            ],
        ]);

        $user = $request->user();

        // Only a pupil account linked to a pupil may download results.
        if ($user->role !== 'student' || ! $user->student_id) {
            abort(403, 'This account is not authorised to download pupil results.');
        }

        $student = $user->student;

        abort_if(! $student, 403, 'No pupil record is linked to this account.');

        // Restrict the request to this pupil's own enrolment.
        $enrollment = $student->enrollments()
            ->with(['academicSession', 'section.classLevel'])
            ->where('academic_session_id', $validated['session_id'])
            ->firstOrFail();

        $term = $validated['term'];
        $session = $enrollment->academicSession;
        $section = $enrollment->section;
        $classLevel = $section->classLevel;

        // Require the exact class, session and term to be published.
        $publicationExists = ClassTermPublication::query()
            ->where('academic_session_id', $enrollment->academic_session_id)
            ->where('section_id', $enrollment->section_id)
            ->where('term', $term)
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->exists();

        if (! $publicationExists) {
            return redirect()
                ->route('parent.dashboard')
                ->with('error', 'Results for ' . $term . ' in '
                    . $session->name . ' are not currently published.');
        }

        // Fee status is checked live on every download request.
        $feeIsPaid = $enrollment->feeStatuses()
            ->where('term', $term)
            ->where('status', StudentFeeStatus::PAID)
            ->exists();

        if (! $feeIsPaid) {
            return redirect()
                ->route('parent.dashboard')
                ->with('error', 'Results for ' . $term . ' are unavailable because the fee status is not Paid.');
        }

        // Every active subject assigned to this pupil's class level is required.
        $requiredSubjectIds = $classLevel->subjects()
            ->where('subjects.is_active', true)
            ->pluck('subjects.id');

        if ($requiredSubjectIds->isEmpty()) {
            return redirect()
                ->route('parent.dashboard')
                ->with('error', 'No active subjects are assigned to this class. Please contact the school.');
        }

        $results = $enrollment->studentResults()
            ->with('subject')
            ->where('term', $term)
            ->whereIn('subject_id', $requiredSubjectIds)
            ->where('status', 'submitted')
            ->whereNotNull('first_assessment')
            ->whereNotNull('second_assessment')
            ->whereNotNull('exam')
            ->whereNotNull('published_at')
            ->orderBy('subject_id')
            ->get();

        // Do not issue a partial report.
        if ($results->count() !== $requiredSubjectIds->count()) {
            return redirect()
                ->route('parent.dashboard')
                ->with('error', 'Your complete results for ' . $term . ' in '
                    . $session->name . ' are not currently available. Please contact the school.');
        }

        $pdf = Pdf::loadView('results.report-pdf', [
            'student' => $student,
            'session' => $session,
            'term' => $term,
            'enrollment' => $enrollment,
            'results' => $results,
        ]);

        $admissionNumber = preg_replace(
            '/[^A-Za-z0-9_-]/',
            '-',
            $student->admission_number
        );

        $sessionName = preg_replace(
            '/[^A-Za-z0-9_-]/',
            '-',
            $session->name
        );

        $termName = str_replace(' ', '-', $term);

        $filename = 'FNPS-Result-'
            . $admissionNumber
            . '-'
            . $sessionName
            . '-'
            . $termName
            . '.pdf';

        return $pdf->download($filename);
    }



    public function editPin(): View
    {
        return view('parent-portal.change-pin');
    }

    public function updatePin(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_pin' => ['required', 'digits:4'],
            'pin' => ['required', 'digits:4', 'confirmed', 'different:current_pin'],
        ]);

        $user = $request->user();

        if (! Hash::check($validated['current_pin'], $user->password)) {
            throw ValidationException::withMessages([
                'current_pin' => 'The current PIN is incorrect.',
            ]);
        }

        $user->password = Hash::make($validated['pin']);
        $user->must_change_pin = false;
        $user->save();

        return redirect()->route('parent.dashboard')
            ->with('success', 'Your PIN has been changed successfully.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('parent.login');
    }
}
