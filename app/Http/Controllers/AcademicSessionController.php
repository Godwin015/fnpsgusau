<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AcademicSessionController extends Controller
{
    public function index(): View
    {
        return view('academic-sessions.index', [
            'sessions' => AcademicSession::orderByDesc('start_date')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:20', 'unique:academic_sessions,name'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'is_current' => ['nullable', 'boolean'],
        ]);

        DB::transaction(function () use ($validated) {
            $isCurrent = (bool) ($validated['is_current'] ?? false);

            if ($isCurrent) {
                AcademicSession::query()->update(['is_current' => false]);
            }

            AcademicSession::create([
                'name' => $validated['name'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'is_current' => $isCurrent,
            ]);
        });

        return redirect()
            ->route('academic-sessions.index')
            ->with('success', 'Academic session created successfully.');
    }

    public function update(Request $request, AcademicSession $academicSession): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:20',
                Rule::unique('academic_sessions', 'name')->ignore($academicSession->id),
            ],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'is_current' => ['nullable', 'boolean'],
        ]);

        DB::transaction(function () use ($validated, $academicSession) {
            $isCurrent = (bool) ($validated['is_current'] ?? false);

            if ($isCurrent) {
                AcademicSession::whereKeyNot($academicSession->id)
                    ->update(['is_current' => false]);
            }

            $academicSession->update([
                'name' => $validated['name'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'is_current' => $isCurrent,
            ]);
        });

        return redirect()
            ->route('academic-sessions.index')
            ->with('success', 'Academic session updated successfully.');
    }

    public function destroy(AcademicSession $academicSession): RedirectResponse
    {
        if ($academicSession->enrollments()->exists()) {
            return back()->with(
                'error',
                'This session has pupil enrolments and cannot be deleted.'
            );
        }

        $academicSession->delete();

        return redirect()
            ->route('academic-sessions.index')
            ->with('success', 'Academic session deleted successfully.');
    }
}
