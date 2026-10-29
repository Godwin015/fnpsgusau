<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class StaffPasswordController extends Controller
{
    public function edit(): View
    {
        return view('staff.change-password');
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => [
                'required',
                'string',
                'min:12',
                'confirmed',
                'different:current_password',
            ],
        ]);

        $user = $request->user();

        if (! Hash::check($validated['current_password'], $user->password)) {
            return back()
                ->withErrors([
                    'current_password' => 'The current password is incorrect.',
                ]);
        }

        $user->password = Hash::make($validated['password']);
        $user->must_change_password = false;
        $user->save();

        return redirect()
            ->route('staff.dashboard')
            ->with('success', 'Your password has been changed successfully.');
    }
}

