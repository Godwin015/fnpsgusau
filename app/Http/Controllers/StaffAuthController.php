<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StaffAuthController extends Controller
{
    public function showLogin(): View
    {
        return view('staff.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $email = Str::lower($validated['email']);

        $key = 'staff-login:'.$email.'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => "Too many login attempts. Try again in {$seconds} seconds.",
                ]);
        }

        if (! Auth::attempt([
            'email' => $email,
            'password' => $validated['password'],
        ])) {
            RateLimiter::hit($key, 60);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'The email or password is incorrect.',
                ]);
        }

        $user = Auth::user();

        $allowedRoles = [
            'super_admin',
            'result_officer',
            'teacher',
        ];

        // Staff accounts must not be linked to a pupil profile.
        if (
            ! $user ||
            ! in_array($user->role, $allowedRoles, true) ||
            $user->student_id !== null
        ) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            RateLimiter::hit($key, 60);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'This account is not authorised for staff login.',
                ]);
        }

        RateLimiter::clear($key);

        $request->session()->regenerate();

        return redirect()->route('staff.dashboard');
    }

    
    public function dashboard(): \Illuminate\View\View
    {
        $user = Auth::user();

        $user->load('assignedSections.classLevel');

        return view('staff.dashboard', [
            'user' => $user,
            'assignedSections' => $user->assignedSections,
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('staff.login')
            ->with('success', 'You have been logged out.');
    }
}

