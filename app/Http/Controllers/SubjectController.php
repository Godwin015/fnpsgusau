<?php

namespace App\Http\Controllers;

use App\Models\ClassLevel;
use App\Models\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SubjectController extends Controller
{
    public function index(): View
    {
        return view('subjects.index', [
            'subjects' => Subject::with('classLevels')
                ->orderBy('name')
                ->paginate(20),

            'classLevels' => ClassLevel::where('is_active', true)
                ->orderBy('sort_order')
                ->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:subjects,name'],
            'code' => ['required', 'string', 'max:30', 'unique:subjects,code'],
            'class_level_ids' => ['required', 'array', 'min:1'],
            'class_level_ids.*' => [
                'required',
                'integer',
                'distinct',
                Rule::exists('class_levels', 'id')->where('is_active', true),
            ],
        ]);

        DB::transaction(function () use ($validated) {
            $subject = Subject::create([
                'name' => trim($validated['name']),
                'code' => strtoupper(trim($validated['code'])),
                'is_active' => true,
            ]);

            $subject->classLevels()->sync($validated['class_level_ids']);
        });

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject created and assigned to the selected class levels.');
    }

    public function update(Request $request, Subject $subject): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('subjects', 'name')->ignore($subject->id),
            ],
            'code' => [
                'required',
                'string',
                'max:30',
                Rule::unique('subjects', 'code')->ignore($subject->id),
            ],
            'is_active' => ['required', 'boolean'],
            'class_level_ids' => ['required', 'array', 'min:1'],
            'class_level_ids.*' => [
                'required',
                'integer',
                'distinct',
                Rule::exists('class_levels', 'id')->where('is_active', true),
            ],
        ]);

        DB::transaction(function () use ($validated, $subject) {
            $subject->update([
                'name' => trim($validated['name']),
                'code' => strtoupper(trim($validated['code'])),
                'is_active' => (bool) $validated['is_active'],
            ]);

            $subject->classLevels()->sync($validated['class_level_ids']);
        });

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject details and class assignments updated.');
    }
}

