<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\PupilProgressionAudit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PupilProgressionAuditController extends Controller
{
    public function index(Request $request): View
    {
        $query = PupilProgressionAudit::query()
            ->with([
                'student',
                'sourceEnrollment.section.classLevel',
                'sourceEnrollment.academicSession',
                'destinationEnrollment.section.classLevel',
                'destinationEnrollment.academicSession',
                'performedBy',
            ])
            ->latest();

        if ($request->filled('action')) {
            $query->where('action', $request->input('action'));
        }

        if ($request->filled('session_id')) {
            $sessionId = $request->integer('session_id');

            $query->where(function ($subquery) use ($sessionId) {
                $subquery
                    ->where('source_session_id', $sessionId)
                    ->orWhere('destination_session_id', $sessionId);
            });
        }

        if ($request->filled('student_search')) {
            $search = trim($request->input('student_search'));

            $query->whereHas('student', function ($studentQuery) use ($search) {
                $studentQuery->where(function ($nameQuery) use ($search) {
                    $nameQuery
                        ->where('admission_number', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('middle_name', 'like', "%{$search}%");
                });
            });
        }

        return view('pupil-progression.audits', [
            'audits' => $query->paginate(25)->withQueryString(),
            'sessions' => AcademicSession::orderByDesc('start_date')->get(),
            'actions' => [
                'promote' => 'Promotion',
                'repeat' => 'Repetition',
                'demote' => 'Demotion',
                'transfer' => 'Transfer',
            ],
        ]);
    }
}