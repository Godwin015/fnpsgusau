<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\ClassLevel;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StaffManagementController extends Controller
{
    /**
     * Display staff accounts and available class sections.
     */
    public function index(): View
    {
        return view('staff-management.index', [
            'staffMembers' => User::query()
                ->whereIn('role', ['teacher', 'result_officer'])
                ->with('assignedSections.classLevel')
                ->orderBy('name')
                ->paginate(20),

            'classLevels' => ClassLevel::query()
                ->where('is_active', true)
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
     * Create a staff account and assign its sections.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'role' => [
                'required',
                Rule::in(['teacher', 'result_officer']),
            ],
            'section_ids' => ['required', 'array', 'min:1'],
            'section_ids.*' => [
                'required',
                'integer',
                'distinct',
                Rule::exists('sections', 'id')
                    ->where('is_active', true),
            ],
        ]);

        $temporaryPassword = Str::random(16);

        DB::transaction(function () use (
            $validated,
            $temporaryPassword
        ) {
            $staff = User::create([
                'name' => trim($validated['name']),
                'email' => strtolower(trim($validated['email'])),
                'password' => Hash::make($temporaryPassword),
                'login_id' => null,
                'student_id' => null,
                'must_change_pin' => false,
                'must_change_password' => true,
                'role' => $validated['role'],
            ]);

            $assignments = [];

            foreach ($validated['section_ids'] as $sectionId) {
                $assignments[(int) $sectionId] = [
                    'assigned_by' => auth()->id(),
                ];
            }

            $staff->assignedSections()->sync($assignments);
        });

        return redirect()
            ->route('staff-management.index')
            ->with('success', 'Staff account created successfully.')
            ->with('temporary_password', $temporaryPassword)
            ->with('created_staff_email', strtolower(trim($validated['email'])));
    }

    /**
     * Replace a staff member's section assignments.
     */
    public function updateAssignments(
        Request $request,
        User $user
    ): RedirectResponse {
        abort_unless(
            in_array($user->role, ['teacher', 'result_officer'], true)
            && $user->student_id === null,
            404
        );

        $validated = $request->validate([
            'section_ids' => ['required', 'array', 'min:1'],
            'section_ids.*' => [
                'required',
                'integer',
                'distinct',
                Rule::exists('sections', 'id')
                    ->where('is_active', true),
            ],
        ]);

        $assignments = [];

        foreach ($validated['section_ids'] as $sectionId) {
            $assignments[(int) $sectionId] = [
                'assigned_by' => auth()->id(),
            ];
        }

        $user->assignedSections()->sync($assignments);

        return redirect()
            ->route('staff-management.index')
            ->with('success', 'Staff section assignments updated successfully.');
    }


    /**
     * Reset a staff member's password and require a change at next login.
     */
    
    public function resetPassword(Request $request, User $user): RedirectResponse
    {
        abort_unless(
            in_array($user->role, ['teacher', 'result_officer'], true)
            && $user->student_id === null,
            404
        );

        $temporaryPassword = Str::random(16);

        DB::transaction(function () use ($user, $temporaryPassword) {
            $lockedUser = User::query()
                ->whereKey($user->id)
                ->lockForUpdate()
                ->firstOrFail();

            $lockedUser->password = Hash::make($temporaryPassword);
            $lockedUser->must_change_password = true;

            // Invalidate remember-me authentication as well.
            $lockedUser->setRememberToken(Str::random(60));
            $lockedUser->save();

            // Revoke every existing database session belonging to this staff account.
            DB::table('sessions')
                ->where('user_id', $lockedUser->id)
                ->delete();
        });

        return redirect()
            ->route('staff-management.index')
            ->with('success', 'The staff password has been reset and existing sessions revoked.')
            ->with('temporary_password', $temporaryPassword)
            ->with('reset_staff_email', $user->email);
    }

}

