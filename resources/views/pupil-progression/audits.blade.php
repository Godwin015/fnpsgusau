<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pupil Progression Audit History | FNPS Gusau</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #eaf2ff, #f5f8ff, #dce9ff);
            color: #17345f;
        }

        /* School Header */

        .school-header {
            background: #ffffff;
            padding: 22px 30px;
            box-shadow: 0 3px 15px rgba(20, 55, 110, 0.08);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .school-logo {
            width: 85px;
            height: 85px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .school-title {
            flex: 1;
            text-align: center;
        }

        .school-title h1 {
            margin: 0;
            color: #123f83;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: 0.4px;
        }

        .school-title p {
            margin: 7px 0 0;
            color: #64748b;
            font-size: 13px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        /* Main Layout */

        .page-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 35px 22px 50px;
        }

        /* Navigation */

        .back-links {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: #2563eb;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #123f83;
        }

        .back-divider {
            color: #a0aec0;
            font-size: 13px;
        }

        /* Page Heading */

        .page-heading {
            margin-bottom: 28px;
        }

        .page-heading h2 {
            margin: 0;
            color: #173f7a;
            font-size: 30px;
            font-weight: 800;
        }

        .page-heading p {
            margin: 10px 0 0;
            color: #718096;
            font-size: 15px;
            line-height: 1.7;
        }

        /* Welcome Banner */

        .welcome-banner {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #1d4ed8, #123f91);
            color: #ffffff;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 12px 30px rgba(29, 78, 216, 0.18);
        }

        .welcome-banner::after {
            content: "";
            position: absolute;
            width: 190px;
            height: 190px;
            right: -65px;
            top: -80px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
        }

        .welcome-banner h2 {
            position: relative;
            z-index: 1;
            margin: 0;
            color: #ffffff;
            font-size: 25px;
            font-weight: 800;
        }

        .welcome-banner p {
            position: relative;
            z-index: 1;
            max-width: 700px;
            margin: 12px 0 0;
            color: #dbeafe;
            font-size: 14px;
            line-height: 1.8;
        }

        /* Messages */

        .message {
            padding: 15px 18px;
            border-radius: 12px;
            margin-bottom: 22px;
            font-size: 14px;
            line-height: 1.7;
        }

        .success {
            color: #166534;
            background: #ecfdf3;
            border: 1px solid #bbf7d0;
        }

        .error {
            color: #991b1b;
            background: #fff1f2;
            border: 1px solid #fecaca;
        }

        .error ul {
            margin-bottom: 0;
            padding-left: 22px;
        }

        /* Panels */

        .panel {
            min-width: 0;
            background: #ffffff;
            border: 1px solid #e2eaf5;
            border-radius: 18px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(30, 64, 125, 0.07);
        }

        .panel-heading {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 23px;
        }

        .panel-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: #e8f0ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .panel-icon svg {
            width: 25px;
            height: 25px;
        }

        .panel-heading h2 {
            margin: 0;
            color: #173f7a;
            font-size: 20px;
            font-weight: 800;
        }

        .panel-heading p {
            margin: 5px 0 0;
            color: #8290a5;
            font-size: 13px;
            line-height: 1.5;
        }

        /* Filter Form */

        .filter-intro {
            margin: 0 0 20px;
            color: #718096;
            font-size: 13px;
            line-height: 1.7;
        }

        .filters {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            align-items: end;
        }

        .filter-field {
            min-width: 0;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #244777;
            font-size: 13px;
            font-weight: 700;
        }

        input[type="text"],
        select {
            display: block;
            width: 100%;
            min-height: 47px;
            padding: 12px 14px;
            border: 1px solid #dbe5f2;
            border-radius: 10px;
            background: #f8faff;
            color: #17345f;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        input[type="text"]:focus,
        select:focus {
            border-color: #60a5fa;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
        }

        input::placeholder {
            color: #94a3b8;
        }

        /* Buttons */

        .filter-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            grid-column: 1 / -1;
            margin-top: 5px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            min-height: 45px;
            padding: 12px 17px;
            border: 1px solid transparent;
            border-radius: 10px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
        }

        .button-primary {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff;
            box-shadow: 0 5px 13px rgba(37, 99, 235, 0.17);
        }

        .button-primary:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            transform: translateY(-1px);
            box-shadow: 0 7px 17px rgba(37, 99, 235, 0.22);
        }

        .button-secondary {
            background: #edf4ff;
            border-color: #dbeafe;
            color: #2453a0;
        }

        .button-secondary:hover {
            background: #dbeafe;
            transform: translateY(-1px);
        }

        /* Audit Summary */

        .audit-summary {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 22px;
            padding: 18px 20px;
            border: 1px solid #dbeafe;
            border-radius: 13px;
            background: linear-gradient(135deg, #f0f6ff, #ffffff);
        }

        .summary-label {
            margin: 0;
            color: #718096;
            font-size: 13px;
            line-height: 1.6;
        }

        .summary-value {
            display: block;
            margin-top: 4px;
            color: #173f7a;
            font-size: 25px;
            font-weight: 800;
        }

        .summary-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 13px;
            border-radius: 20px;
            background: #e8f0ff;
            color: #2453a0;
            font-size: 12px;
            font-weight: 800;
        }

        .summary-badge svg {
            width: 16px;
            height: 16px;
        }

        /* Table */

        .table-wrap {
            width: 100%;
            overflow-x: auto;
            border: 1px solid #e2eaf5;
            border-radius: 13px;
            background: #ffffff;
        }

        table {
            width: 100%;
            min-width: 1050px;
            border-collapse: separate;
            border-spacing: 0;
        }

        thead {
            background: #edf4ff;
        }

        th {
            padding: 15px 14px;
            border-bottom: 1px solid #dbe5f2;
            color: #244777;
            text-align: left;
            vertical-align: middle;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        td {
            padding: 16px 14px;
            border-bottom: 1px solid #edf2f8;
            color: #334e73;
            text-align: left;
            vertical-align: top;
            font-size: 13px;
            line-height: 1.7;
        }

        tbody tr {
            transition: background 0.2s;
        }

        tbody tr:hover {
            background: #f5f9ff;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .date-cell {
            min-width: 150px;
            color: #64748b;
            white-space: nowrap;
            font-size: 12px;
        }

        .pupil-name {
            display: block;
            color: #1e4580;
            font-weight: 800;
            line-height: 1.6;
        }

        .muted {
            display: block;
            margin-top: 4px;
            color: #8290a5;
            font-size: 11px;
            line-height: 1.6;
        }

        .action-label {
            display: inline-flex;
            align-items: center;
            padding: 7px 10px;
            border-radius: 8px;
            background: #e8f0ff;
            color: #2453a0;
            font-size: 11px;
            font-weight: 800;
            line-height: 1.5;
        }

        .movement-cell {
            min-width: 155px;
        }

        .movement-class {
            display: block;
            color: #1e4580;
            font-weight: 700;
            line-height: 1.6;
        }

        .movement-session {
            display: block;
            margin-top: 5px;
            color: #8290a5;
            font-size: 11px;
            line-height: 1.6;
        }

        .note-cell {
            min-width: 180px;
            max-width: 260px;
            overflow-wrap: anywhere;
            color: #526783;
        }

        .performed-cell {
            min-width: 150px;
            color: #244777;
            font-weight: 700;
        }

        /* Empty State */

        .empty-state {
            padding: 40px 20px;
            text-align: center;
            background: #f8faff;
            border: 1px dashed #cbd9eb;
            border-radius: 14px;
        }

        .empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            margin: 0 auto 15px;
            border-radius: 16px;
            background: #e8f0ff;
            color: #2563eb;
        }

        .empty-icon svg {
            width: 28px;
            height: 28px;
        }

        .empty-state h3 {
            margin: 0 0 9px;
            color: #244777;
            font-size: 17px;
        }

        .empty-state p {
            max-width: 450px;
            margin: 0 auto;
            color: #718096;
            font-size: 13px;
            line-height: 1.8;
        }

        /* Pagination */

        .pagination-wrap {
            margin-top: 23px;
            overflow-x: auto;
        }

        .pagination-wrap nav {
            display: flex;
            justify-content: center;
        }

        .pagination-wrap svg {
            width: 16px;
            height: 16px;
        }

        /* Footer */

        .footer {
            padding: 20px 15px;
            text-align: center;
            color: #718096;
            font-size: 12px;
            line-height: 1.7;
        }

        .footer strong {
            color: #31558a;
        }

        /* Responsive */

        @media (max-width: 900px) {
            .filters {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .filter-actions {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 600px) {
            .school-header {
                padding: 17px 14px;
            }

            .header-content {
                gap: 10px;
            }

            .school-logo {
                width: 58px;
                height: 58px;
            }

            .school-title h1 {
                font-size: 18px;
            }

            .school-title p {
                font-size: 10px;
                letter-spacing: 0.7px;
            }

            .page-container {
                padding: 25px 15px 35px;
            }

            .page-heading h2 {
                font-size: 25px;
            }

            .welcome-banner {
                padding: 23px;
                border-radius: 16px;
            }

            .welcome-banner h2 {
                font-size: 21px;
            }

            .panel {
                padding: 20px;
                border-radius: 16px;
            }

            .panel-heading h2 {
                font-size: 18px;
            }

            .filters {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .filter-actions {
                grid-column: auto;
                flex-direction: column;
                align-items: stretch;
            }

            .filter-actions .button {
                width: 100%;
            }

            .audit-summary {
                align-items: flex-start;
                flex-direction: column;
            }

            .summary-value {
                font-size: 23px;
            }

            .back-links {
                gap: 9px;
            }
        }

        @media (max-width: 360px) {
            .school-logo {
                width: 48px;
                height: 48px;
            }

            .school-title h1 {
                font-size: 15px;
            }

            .school-title p {
                font-size: 9px;
            }

            .page-container {
                padding-left: 12px;
                padding-right: 12px;
            }

            .panel {
                padding: 16px;
            }

            .welcome-banner {
                padding: 19px;
            }
        }
    </style>
</head>

<body>

    <!-- School Header -->

    <header class="school-header">
        <div class="header-content">

            <img
                src="{{ asset('images/school-logo.jpeg') }}"
                alt="FNPS Gusau School Logo"
                class="school-logo"
            >

            <div class="school-title">
                <h1>Fatima Nursery and Primary School</h1>
                <p>Gusau, Zamfara State</p>
            </div>

            <img
                src="{{ asset('images/second-school-logo.jpeg') }}"
                alt="FNPS Gusau Second School Logo"
                class="school-logo"
            >

        </div>
    </header>

    <!-- Main Page -->

    <main class="page-container">

        <!-- Page Heading -->

        <div class="page-heading">
            <h2>Pupil Progression Audit History</h2>

            <p>
                Review pupil promotions, transfers and progression records
                at Fatima Nursery and Primary School, Gusau.
            </p>
        </div>

        <!-- Navigation -->

        <div class="back-links">

            <a
            href="{{ route('staff-management.index') }}"
            class="back-link"
        >

            <span aria-hidden="true">←</span>

            Back to Staff Management

        </a>
        </div>

        <!-- Welcome Banner -->

        <section class="welcome-banner">

            <h2>Progression Records &amp; History</h2>

            <p>
                View the history of pupil promotions and transfers,
                including the academic sessions, classes, recorded
                reasons and staff members responsible for each action.
                Use the filters below to locate specific audit records.
            </p>

        </section>

        <!-- Filter Panel -->

        <section class="panel">

            <div class="panel-heading">

                <div class="panel-icon">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <circle cx="11" cy="11" r="7"/>
                        <path d="m20 20-4-4"/>
                        <path d="M8 11h6"/>
                        <path d="M11 8v6"/>
                    </svg>
                </div>

                <div>
                    <h2>Filter Audit Records</h2>
                    <p>Search and narrow down progression history</p>
                </div>

            </div>

            <p class="filter-intro">
                Enter a pupil name or admission number, choose an action
                or academic session, and select Filter to view matching records.
            </p>

            <form
                method="GET"
                action="{{ route('pupil-progression.audits') }}"
                class="filters"
            >

                <!-- Pupil Search -->

                <div class="filter-field">

                    <label for="student_search">
                        Pupil / Admission Number
                    </label>

                    <input
                        id="student_search"
                        type="text"
                        name="student_search"
                        value="{{ request('student_search') }}"
                        placeholder="Search pupil or admission number"
                    >

                </div>

                <!-- Action Filter -->

                <div class="filter-field">

                    <label for="action">
                        Progression Action
                    </label>

                    <select id="action" name="action">

                        <option value="">
                            All actions
                        </option>

                        @foreach ($actions as $value => $label)

                            <option
                                value="{{ $value }}"
                                @selected(request('action') === $value)
                            >
                                {{ $label }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Academic Session Filter -->

                <div class="filter-field">

                    <label for="session_id">
                        Academic Session
                    </label>

                    <select id="session_id" name="session_id">

                        <option value="">
                            All sessions
                        </option>

                        @foreach ($sessions as $session)

                            <option
                                value="{{ $session->id }}"
                                @selected(
                                    (string) request('session_id')
                                    === (string) $session->id
                                )
                            >
                                {{ $session->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Filter Actions -->

                <div class="filter-actions">

                    <button
                        type="submit"
                        class="button button-primary"
                    >
                        <span aria-hidden="true">⌕</span>
                        Filter Records
                    </button>

                    <a
                        href="{{ route('pupil-progression.audits') }}"
                        class="button button-secondary"
                    >
                        Clear Filters
                    </a>

                </div>

            </form>

        </section>

        <!-- Audit History Panel -->

        <section class="panel">

            <!-- Panel Heading -->

            <div class="panel-heading">

                <div class="panel-icon">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                        <path d="M8 7h8"/>
                        <path d="M8 11h8"/>
                        <path d="M8 15h5"/>
                    </svg>
                </div>

                <div>
                    <h2>Audit Records</h2>
                    <p>Recorded pupil progression activities</p>
                </div>

            </div>

            <!-- Records Summary -->

            <div class="audit-summary">

                <div>
                    <p class="summary-label">
                        Total records matching your filters
                    </p>

                    <span class="summary-value">
                        {{ $audits->total() }}
                    </span>
                </div>

                <span class="summary-badge">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M12 8v4l3 2"/>
                        <circle cx="12" cy="12" r="9"/>
                    </svg>

                    Progression History

                </span>

            </div>

            <!-- Audit Table -->

            @if ($audits->count())

                <div class="table-wrap">

                    <table>

                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Pupil</th>
                                <th>Action</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Reason / Note</th>
                                <th>Performed By</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($audits as $audit)

                                <tr>

                                    <!-- Date -->

                                    <td class="date-cell">
                                        {{ $audit->created_at?->format('d M Y, h:i A') }}
                                    </td>

                                    <!-- Pupil -->

                                    <td>

                                        <span class="pupil-name">
                                            {{ $audit->student?->last_name }},
                                            {{ $audit->student?->first_name }}
                                            {{ $audit->student?->middle_name }}
                                        </span>

                                        <span class="muted">
                                            {{ $audit->student?->admission_number ?? 'Pupil record unavailable' }}
                                        </span>

                                    </td>

                                    <!-- Action -->

                                    <td>

                                        <span class="action-label">
                                            {{ $actions[$audit->action] ?? ucfirst($audit->action) }}
                                        </span>

                                    </td>

                                    <!-- Source -->

                                    <td class="movement-cell">

                                        <span class="movement-class">
                                            {{ $audit->sourceEnrollment?->section?->classLevel?->name ?? '—' }}
                                            {{ $audit->sourceEnrollment?->section?->name ?? '' }}
                                        </span>

                                        <span class="movement-session">
                                            {{ $audit->sourceEnrollment?->academicSession?->name ?? '—' }}
                                        </span>

                                    </td>

                                    <!-- Destination -->

                                    <td class="movement-cell">

                                        <span class="movement-class">
                                            {{ $audit->destinationEnrollment?->section?->classLevel?->name ?? '—' }}
                                            {{ $audit->destinationEnrollment?->section?->name ?? '' }}
                                        </span>

                                        <span class="movement-session">
                                            {{ $audit->destinationEnrollment?->academicSession?->name ?? '—' }}
                                        </span>

                                    </td>

                                    <!-- Note -->

                                    <td class="note-cell">
                                        {{ $audit->note ?: '—' }}
                                    </td>

                                    <!-- Staff Member -->

                                    <td class="performed-cell">
                                        {{ $audit->performedBy?->name ?? 'Account unavailable' }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <!-- Empty State -->

                <div class="empty-state">

                    <div class="empty-icon">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <circle cx="11" cy="11" r="7"/>
                            <path d="m20 20-4-4"/>
                            <path d="M8 11h6"/>
                        </svg>

                    </div>

                    <h3>No Audit Records Found</h3>

                    <p>
                        No progression audit records match these filters.
                        Try changing your search criteria or clearing
                        the filters to view the available history.
                    </p>

                </div>

            @endif

            <!-- Pagination -->

            @if ($audits->hasPages())

                <div class="pagination-wrap">
                    {{ $audits->links() }}
                </div>

            @endif

        </section>

    </main>

    <!-- Footer -->

    <footer class="footer">

        &copy; {{ date('Y') }}

        <strong>
            Fatima Nursery and Primary School, Gusau
        </strong>.

        All rights reserved.

    </footer>

</body>
</html>
