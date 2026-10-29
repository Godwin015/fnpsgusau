<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StudentPinResetController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $students = Student::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($studentQuery) use ($search) {
                    $studentQuery
                        ->where('admission_number', 'like', '%' . $search . '%')
                        ->orWhere('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhere('middle_name', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(20)
            ->withQueryString();

        $accounts = User::query()
            ->whereIn('student_id', $students->getCollection()->pluck('id'))
            ->where('role', 'student')
            ->get()
            ->keyBy('student_id');

        return view('staff-management.pupil-pin-resets', [
            'students' => $students,
            'accounts' => $accounts,
            'search' => $search,
        ]);
    }

    
    public function reset(Request $request, Student $student): RedirectResponse
    {
        $account = User::query()
            ->where('student_id', $student->id)
            ->where('role', 'student')
            ->firstOrFail();

        $temporaryPin = str_pad(
            (string) random_int(0, 9999),
            4,
            '0',
            STR_PAD_LEFT
        );

        DB::transaction(function () use ($account, $temporaryPin) {
            $lockedAccount = User::query()
                ->whereKey($account->id)
                ->lockForUpdate()
                ->firstOrFail();

            $lockedAccount->password = Hash::make($temporaryPin);
            $lockedAccount->must_change_pin = true;

            // Invalidate remember-me authentication as well.
            $lockedAccount->setRememberToken(Str::random(60));
            $lockedAccount->save();

            // Revoke every existing database session belonging to this pupil.
            DB::table('sessions')
                ->where('user_id', $lockedAccount->id)
                ->delete();
        });

        return redirect()
            ->route('staff-management.pupil-pin-resets', [
                'search' => $student->admission_number,
            ])
            ->with('success', 'The pupil PIN has been reset and existing sessions revoked.')
            ->with('temporary_pupil_pin', $temporaryPin)
            ->with('reset_pupil_name', trim(
                $student->first_name . ' '
                . ($student->middle_name ? $student->middle_name . ' ' : '')
                . $student->last_name
            ))
            ->with('reset_pupil_admission', $student->admission_number);
    }
}
