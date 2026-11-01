<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\ClassLevel;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $studentsQuery = Student::with([
            'enrollments' => fn ($query) => $query
                ->with(['academicSession', 'section.classLevel'])
                ->orderByDesc('id'),
        ]);

        // Search by admission number, first name, middle name, or surname.
        if ($search !== '') {
            $studentsQuery->where(function ($query) use ($search) {
                $query->where('admission_number', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('middle_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        return view('students.index', [
            'students' => $studentsQuery
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->paginate(40)
                ->withQueryString(),

            'search' => $search,

            'classLevels' => ClassLevel::where('is_active', true)
                ->with([
                    'sections' => fn ($query) => $query
                        ->where('is_active', true)
                        ->orderBy('name'),
                ])
                ->orderBy('sort_order')
                ->get(),

            'currentSession' => AcademicSession::where('is_current', true)->first(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'middle_name' => ['nullable', 'string', 'max:100'],
            'date_of_birth' => ['nullable', 'date', 'before_or_equal:today'],
            'gender' => ['nullable', Rule::in(['male', 'female'])],
            'section_id' => [
                'required',
                'integer',
                Rule::exists('sections', 'id')->where('is_active', true),
            ],
        ]);

        $currentSession = AcademicSession::where('is_current', true)->first();

        if (! $currentSession) {
            return back()->withInput()->withErrors([
                'section_id' => 'Set a current academic session before registering pupils.',
            ]);
        }

        $credentials = DB::transaction(function () use ($validated, $currentSession) {
            // Generate a unique admission number.
            do {
                $admissionNumber = 'FNPS-' . now()->format('Y') . '-'
                    . str_pad((string) random_int(1, 999999), 6, '0', STR_PAD_LEFT);
            } while (Student::where(
                'admission_number',
                $admissionNumber
            )->exists());

            // Generate a four-digit PIN, including possible leading zeros.
            $pin = str_pad(
                (string) random_int(0, 9999),
                4,
                '0',
                STR_PAD_LEFT
            );

            $student = Student::create([
                'admission_number' => $admissionNumber,
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'middle_name' => $validated['middle_name'] ?? null,
                'date_of_birth' => $validated['date_of_birth'] ?? null,
                'gender' => $validated['gender'] ?? null,
                'status' => 'active',
            ]);

            Enrollment::create([
                'student_id' => $student->id,
                'academic_session_id' => $currentSession->id,
                'section_id' => $validated['section_id'],
                'promotion_status' => 'pending',
                'enrollment_status' => 'enrolled',
            ]);

            User::create([
                'name' => trim(
                    $student->first_name . ' '
                    . ($student->middle_name ? $student->middle_name . ' ' : '')
                    . $student->last_name
                ),
                // Internal placeholder; this is not a real email address.
                'email' => strtolower($admissionNumber) . '@pupils.fnpsgusau.invalid',
                'login_id' => $admissionNumber,
                'student_id' => $student->id,
                'password' => Hash::make($pin),
                'must_change_pin' => true,
            ]);

            return [
                'admission_number' => $admissionNumber,
                'pin' => $pin,
            ];
        });

        return redirect()
            ->route('students.index')
            ->with('success', 'Pupil registered successfully.')
            ->with('generated_credentials', $credentials);
    }

    public function updateStatus(Request $request, Student $student): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $student->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('students.index', $request->only('search', 'page'))
            ->with('success', 'Pupil status updated successfully.');
    }
}

