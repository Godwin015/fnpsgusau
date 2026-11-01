<?php

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function getStudentsProperty()
    {
        $search = trim($this->search);

        $studentsQuery = Student::with([
            'enrollments' => fn ($query) => $query
                ->with(['academicSession', 'section.classLevel'])
                ->orderByDesc('id'),
        ]);

        if ($search !== '') {
            $studentsQuery->where(function ($query) use ($search) {
                $query->where('admission_number', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('middle_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        return $studentsQuery
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(40);
    }
};
?>

<div>

    {{-- PUPIL SEARCH --}}

    <div
        style="
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        "
    >

        <input
            type="search"
            wire:model.live.debounce.300ms="search"
            class="form-control"
            placeholder="Search admission number or pupil name..."
            aria-label="Search pupils"
            style="
                flex: 1;
                min-width: 220px;
            "
        >

        @if (trim($search) !== '')

            <button
                type="button"
                wire:click="$set('search', '')"
                class="btn btn-outline"
            >
                Clear Search
            </button>

        @endif

    </div>

    {{-- SEARCHING INDICATOR --}}

    <div
        wire:loading
        wire:target="search"
        style="
            margin-bottom: 12px;
            color: #1764d8;
            font-size: 12px;
            font-weight: 700;
        "
    >
        Searching pupils...
    </div>

    {{-- PUPIL TABLE --}}

    <div class="table-wrap">

        <table>

            <thead>

                <tr>
                    <th>Admission No.</th>
                    <th>Pupil Name</th>
                    <th>Current Listed Enrolment</th>
                    <th>Status</th>
                    <th>Update Status</th>
                </tr>

            </thead>

            <tbody>

                @forelse ($this->students as $student)

                    @php
                        $enrolment = $student->enrollments->first();
                    @endphp

                    <tr wire:key="student-{{ $student->id }}">

                        {{-- ADMISSION NUMBER --}}

                        <td>

                            <span class="admission-number">
                                {{ $student->admission_number }}
                            </span>

                        </td>

                        {{-- PUPIL NAME --}}

                        <td>

                            <span class="pupil-name">

                                {{ $student->last_name }},
                                {{ $student->first_name }}
                                {{ $student->middle_name }}

                            </span>

                        </td>

                        {{-- CURRENT ENROLMENT --}}

                        <td>

                            @if ($enrolment)

                                {{ $enrolment->section->classLevel->name }}
                                -
                                {{ $enrolment->section->name }}

                                <div class="form-hint">

                                    {{ $enrolment->academicSession->name }}

                                </div>

                            @else

                                <span class="text-muted">
                                    No enrolment
                                </span>

                            @endif

                        </td>

                        {{-- CURRENT STATUS --}}

                        <td>

                            @if ($student->status === 'active')

                                <span
                                    class="status-badge"
                                    style="
                                        background: #dcfce7;
                                        color: #166534;
                                    "
                                >
                                    Active
                                </span>

                            @else

                                <span
                                    class="status-badge"
                                    style="
                                        background: #fee2e2;
                                        color: #991b1b;
                                    "
                                >
                                    Inactive
                                </span>

                            @endif

                        </td>

                        {{-- CHANGE STATUS --}}

                        <td>

                            <form
                                method="POST"
                                action="{{ route('students.status.update', $student) }}"
                                style="
                                    display: flex;
                                    align-items: center;
                                    gap: 8px;
                                    min-width: 180px;
                                "
                            >

                                @csrf

                                @method('PATCH')

                                <input
                                    type="hidden"
                                    name="search"
                                    value="{{ $search }}"
                                >

                                <select
                                    name="status"
                                    class="form-control"
                                    aria-label="Change pupil status"
                                    style="
                                        min-width: 110px;
                                        min-height: 38px;
                                        padding: 8px;
                                        font-size: 12px;
                                    "
                                >

                                    <option
                                        value="active"
                                        @selected($student->status === 'active')
                                    >
                                        Active
                                    </option>

                                    <option
                                        value="inactive"
                                        @selected($student->status === 'inactive')
                                    >
                                        Inactive
                                    </option>

                                </select>

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                    style="
                                        padding: 9px 12px;
                                        font-size: 12px;
                                        white-space: nowrap;
                                    "
                                    onclick="return confirm('Are you sure you want to change this pupil status?')"
                                >
                                    Update
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5">

                            <div class="empty-state">

                                <strong>

                                    @if (trim($search) !== '')

                                        No pupils found.

                                    @else

                                        No pupils registered yet.

                                    @endif

                                </strong>

                                <p>

                                    @if (trim($search) !== '')

                                        Try searching with a different name
                                        or admission number.

                                    @else

                                        Registered pupils will appear here
                                        after registration.

                                    @endif

                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- PAGINATION INFORMATION --}}

    <div
        style="
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
            color: #64748b;
            font-size: 12px;
        "
    >

        <span>

            Showing {{ $this->students->firstItem() ?? 0 }}
            to {{ $this->students->lastItem() ?? 0 }}
            of {{ $this->students->total() }} pupils

        </span>

        <span>
            40 pupils per page
        </span>

    </div>

    {{-- PAGINATION --}}

    <div class="pagination-wrap">

        {{ $this->students->links() }}

    </div>

</div>
