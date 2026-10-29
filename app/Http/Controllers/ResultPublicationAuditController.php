<?php

namespace App\Http\Controllers;

use App\Models\ResultPublicationAudit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResultPublicationAuditController extends Controller
{
    public function index(Request $request): View
    {
        $query = ResultPublicationAudit::query()
            ->with([
                'academicSession',
                'section.classLevel',
                'performedBy',
            ])
            ->latest();

        if ($request->filled('session_id')) {
            $query->where(
                'academic_session_id',
                $request->integer('session_id')
            );
        }

        if ($request->filled('section_id')) {
            $query->where(
                'section_id',
                $request->integer('section_id')
            );
        }

        if ($request->filled('term')) {
            $query->where('term', $request->query('term'));
        }

        $audits = $query->paginate(25)->withQueryString();

        return view('staff-management.publication-audits', [
            'audits' => $audits,
            'sessions' => \App\Models\AcademicSession::orderByDesc('id')->get(),
            'sections' => \App\Models\Section::with('classLevel')
                ->orderBy('class_level_id')
                ->orderBy('name')
                ->get(),
            'terms' => [
                'First Term',
                'Second Term',
                'Third Term',
            ],
        ]);
    }
}
