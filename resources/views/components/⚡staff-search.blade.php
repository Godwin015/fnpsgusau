<?php

use App\Models\User;
use App\Models\ClassLevel;
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

    public function getStaffMembersProperty()
    {
        $search = trim($this->search);

        $staffQuery = User::query()
            ->whereIn('role', ['teacher', 'result_officer'])
            ->whereNull('student_id')
            ->with('assignedSections.classLevel');

        if ($search !== '') {
            $staffQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%");
            });
        }

        return $staffQuery
            ->orderBy('name')
            ->paginate(40);
    }

    public function getClassLevelsProperty()
    {
        return ClassLevel::query()
            ->where('is_active', true)
            ->with([
                'sections' => fn ($query) => $query
                    ->where('is_active', true)
                    ->orderBy('name'),
            ])
            ->orderBy('sort_order')
            ->get();
    }
};
?>

<div>

    {{-- LIVE STAFF SEARCH --}}

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
            placeholder="Search staff name, email or role..."
            aria-label="Search staff"
            style="
                flex: 1;
                min-width: 220px;
                min-height: 45px;
                padding: 12px 14px;
                border: 1px solid #dbe5f2;
                border-radius: 10px;
                background: #f8faff;
                color: #17345f;
                font-family: inherit;
                font-size: 14px;
                outline: none;
            "
        >

        @if (trim($search) !== '')

            <button
                type="button"
                wire:click="$set('search', '')"
                class="button button-secondary"
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
        Searching staff...
    </div>

    {{-- STAFF TABLE --}}

    <div style="overflow-x: auto;">

        <table
            style="
                width: 100%;
                min-width: 900px;
                border-collapse: collapse;
                background: #ffffff;
            "
        >

            <thead>

                <tr style="background: #edf4ff;">

                    <th style="padding: 14px; text-align: left;">
                        Staff Name
                    </th>

                    <th style="padding: 14px; text-align: left;">
                        Email
                    </th>

                    <th style="padding: 14px; text-align: left;">
                        Role
                    </th>

                    <th style="padding: 14px; text-align: left;">
                        Assigned Sections
                    </th>

                    <th style="padding: 14px; text-align: left;">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse ($this->staffMembers as $staff)

                    <tr
                        wire:key="staff-{{ $staff->id }}"
                        style="border-bottom: 1px solid #e2eaf5;"
                    >

                        {{-- STAFF NAME --}}

                        <td style="padding: 16px; vertical-align: top;">

                            <strong style="color: #1e4580;">
                                {{ $staff->name }}
                            </strong>

                        </td>

                        {{-- EMAIL --}}

                        <td
                            style="
                                padding: 16px;
                                vertical-align: top;
                                color: #64748b;
                                overflow-wrap: anywhere;
                            "
                        >

                            {{ $staff->email }}

                        </td>

                        {{-- ROLE --}}

                        <td style="padding: 16px; vertical-align: top;">

                            <span
                                style="
                                    display: inline-block;
                                    padding: 6px 10px;
                                    border-radius: 20px;
                                    background: #e8f0ff;
                                    color: #2453a0;
                                    font-size: 11px;
                                    font-weight: 800;
                                    white-space: nowrap;
                                "
                            >

                                {{ ucfirst(str_replace('_', ' ', $staff->role)) }}

                            </span>

                        </td>

                        {{-- ASSIGNED SECTIONS --}}

                        <td
                            style="
                                padding: 16px;
                                vertical-align: top;
                                color: #64748b;
                                font-size: 12px;
                                line-height: 1.8;
                            "
                        >

                            @forelse ($staff->assignedSections as $assignedSection)

                                <div>

                                    {{ $assignedSection->classLevel->name }}
                                    -
                                    {{ $assignedSection->name }}

                                </div>

                            @empty

                                <span style="color: #94a3b8;">
                                    No sections assigned
                                </span>

                            @endforelse

                        </td>

                        {{-- ACTIONS --}}

                        <td
                            style="
                                padding: 16px;
                                vertical-align: top;
                                min-width: 210px;
                            "
                        >

                            {{-- RESET PASSWORD --}}

                            <form
                                method="POST"
                                action="{{ route('staff-management.password.reset', $staff) }}"
                                onsubmit="return confirm('Reset the password for this staff member?');"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="button button-danger"
                                    style="
                                        width: 100%;
                                        margin-bottom: 12px;
                                    "
                                >

                                    🔐 Reset Password

                                </button>

                            </form>

                            {{-- SECTION ASSIGNMENTS --}}

                            <details class="assignment-details">

                                <summary>
                                    Change Assignments
                                </summary>

                                <form
                                    method="POST"
                                    action="{{ route('staff-management.assignments.update', $staff) }}"
                                    style="margin-top: 15px;"
                                >

                                    @csrf

                                    @method('PUT')

                                    @foreach ($this->classLevels as $classLevel)

                                        <div class="class-level">

                                            <h4>
                                                {{ $classLevel->name }}
                                            </h4>

                                            <div class="section-list">

                                                @foreach ($classLevel->sections as $section)

                                                    <label class="section-item">

                                                        <input
                                                            type="checkbox"
                                                            name="section_ids[]"
                                                            value="{{ $section->id }}"
                                                            @checked(
                                                                $staff->assignedSections->contains(
                                                                    'id',
                                                                    $section->id
                                                                )
                                                            )
                                                        >

                                                        <span>
                                                            {{ $section->name }}
                                                        </span>

                                                    </label>

                                                @endforeach

                                            </div>

                                        </div>

                                    @endforeach

                                    <button
                                        type="submit"
                                        class="button button-secondary"
                                        style="
                                            width: 100%;
                                            margin-top: 15px;
                                        "
                                    >

                                        Save Assignments

                                    </button>

                                </form>

                            </details>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" style="padding: 25px;">

                            <div class="empty-state">

                                <div class="empty-icon">
                                    👥
                                </div>

                                <h3>

                                    @if (trim($search) !== '')

                                        No Staff Found

                                    @else

                                        No Staff Accounts Yet

                                    @endif

                                </h3>

                                <p>

                                    @if (trim($search) !== '')

                                        Try searching with another
                                        staff name, email or role.

                                    @else

                                        Staff accounts created
                                        through the form above
                                        will appear here.

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

            Showing {{ $this->staffMembers->firstItem() ?? 0 }}
            to {{ $this->staffMembers->lastItem() ?? 0 }}
            of {{ $this->staffMembers->total() }} staff members

        </span>

        <span>
            40 staff members per page
        </span>

    </div>

    {{-- PAGINATION --}}

    <div class="pagination-container">

        {{ $this->staffMembers->links() }}

    </div>

</div>
