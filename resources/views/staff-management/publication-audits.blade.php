<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Publication Audit History | FNPS Gusau</title>

    <style>
        :root {
            --blue-950: #102b55;
            --blue-900: #173b70;
            --blue-800: #1e4f91;
            --blue-700: #2563b8;
            --blue-600: #3478d4;
            --blue-100: #e8f2ff;
            --blue-50: #f3f8ff;

            --text: #24344d;
            --muted: #718096;
            --border: #e2eaf4;
            --white: #ffffff;

            --green: #16794b;
            --green-bg: #eaf8f0;

            --amber: #946200;
            --amber-bg: #fff8e8;

            --shadow: 0 12px 35px rgba(25, 65, 120, 0.08);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            color: var(--text);

            background:
                radial-gradient(
                    circle at top left,
                    #e3efff 0,
                    transparent 35%
                ),
                linear-gradient(
                    135deg,
                    #f2f7ff 0%,
                    #f8fbff 50%,
                    #edf5ff 100%
                );
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        /* School Header */

        .school-header {
            background: rgba(255, 255, 255, 0.96);
            border-bottom: 1px solid #dce8f7;
            box-shadow: 0 4px 18px rgba(25, 65, 120, 0.04);
        }

        .school-header-inner {
            max-width: 1240px;
            margin: 0 auto;
            padding: 22px 24px;

            display: grid;
            grid-template-columns: 100px 1fr 100px;
            align-items: center;
            gap: 22px;
        }

        .school-logo {
            display: block;
            width: 130px;
            height: 130px;
            object-fit: contain;
            margin: 0 auto;
        }

        .school-brand {
            text-align: center;
        }

        .school-brand h1 {
            margin: 0;
            color: var(--blue-950);
            font-size: clamp(21px, 3vw, 31px);
            font-weight: 800;
            letter-spacing: -0.7px;
        }

        .school-brand p {
            margin: 8px 0 0;
            color: var(--muted);
            font-size: 14px;
        }

        .school-tagline {
            display: inline-block;
            margin-top: 12px;
            padding: 6px 13px;
            border-radius: 999px;

            color: var(--blue-800);
            background: var(--blue-100);

            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.1px;
            text-transform: uppercase;
        }

        /* Page */

        .page-container {
            width: min(1180px, calc(100% - 36px));
            margin: 30px auto 50px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 9px;

            margin-bottom: 22px;

            color: var(--blue-800);
            font-size: 14px;
            font-weight: 700;

            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: var(--blue-600);
        }

        .back-link svg {
            width: 18px;
            height: 18px;
        }

        .page-heading {
            margin-bottom: 24px;
        }

        .page-heading h2 {
            margin: 0;
            color: var(--blue-950);

            font-size: clamp(25px, 4vw, 34px);
            font-weight: 800;
            letter-spacing: -0.8px;
        }

        .page-heading p {
            margin: 10px 0 0;
            color: var(--muted);

            font-size: 15px;
            line-height: 1.7;
        }

        /* Welcome Banner */

        .welcome-banner {
            position: relative;
            overflow: hidden;

            padding: 27px 30px;
            margin-bottom: 26px;

            border-radius: 20px;
            color: white;

            background:
                radial-gradient(
                    circle at 90% 10%,
                    rgba(255, 255, 255, 0.18),
                    transparent 30%
                ),
                linear-gradient(
                    120deg,
                    #173b70 0%,
                    #2563b8 55%,
                    #4389e4 100%
                );

            box-shadow: 0 14px 30px rgba(37, 99, 184, 0.18);
        }

        .welcome-banner::after {
            content: "";
            position: absolute;
            right: -55px;
            bottom: -115px;

            width: 250px;
            height: 250px;

            border: 35px solid rgba(255, 255, 255, 0.08);
            border-radius: 50%;

            pointer-events: none;
        }

        .welcome-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
        }

        .welcome-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 13px;
            padding: 7px 11px;

            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 999px;

            background: rgba(255, 255, 255, 0.12);

            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .welcome-label svg {
            width: 15px;
            height: 15px;
        }

        .welcome-banner h3 {
            margin: 0;
            font-size: clamp(20px, 3vw, 27px);
            font-weight: 800;
        }

        .welcome-banner p {
            margin: 11px 0 0;
            max-width: 700px;

            color: rgba(255, 255, 255, 0.88);
            font-size: 14px;
            line-height: 1.8;
        }

        /* Panels */

        .panel {
            margin-bottom: 25px;
            padding: 25px;

            border: 1px solid var(--border);
            border-radius: 18px;

            background: var(--white);
            box-shadow: var(--shadow);
        }

        .panel-heading {
            display: flex;
            align-items: flex-start;
            gap: 13px;

            margin-bottom: 22px;
        }

        .panel-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;
            width: 46px;
            height: 46px;

            border-radius: 13px;

            color: var(--blue-700);
            background: var(--blue-100);
        }

        .panel-icon svg {
            width: 23px;
            height: 23px;
        }

        .panel-heading h3 {
            margin: 2px 0 0;
            color: var(--blue-950);
            font-size: 19px;
            font-weight: 800;
        }

        .panel-heading p {
            margin: 7px 0 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        /* Filter Form */

        .filters {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 19px;
        }

        .form-field {
            min-width: 0;
        }

        .form-field label {
            display: block;
            margin-bottom: 9px;

            color: #344967;
            font-size: 13px;
            font-weight: 700;
        }

        .form-field select {
            display: block;
            width: 100%;
            min-height: 49px;
            padding: 12px 14px;

            border: 1px solid #d7e2f0;
            border-radius: 11px;

            color: var(--text);
            background: #fbfdff;

            outline: none;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        .form-field select:focus {
            border-color: var(--blue-600);
            box-shadow: 0 0 0 4px rgba(52, 120, 212, 0.12);
        }

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;

            margin-top: 23px;
            padding-top: 20px;

            border-top: 1px solid #edf2f8;
        }

        .filter-note {
            display: flex;
            align-items: center;
            gap: 8px;

            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .filter-note svg {
            flex-shrink: 0;
            width: 17px;
            height: 17px;
            color: var(--blue-600);
        }

        /* Buttons */

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;

            min-height: 44px;
            padding: 11px 17px;

            border: 1px solid transparent;
            border-radius: 10px;

            font-size: 13px;
            font-weight: 800;

            transition:
                background 0.2s ease,
                border-color 0.2s ease,
                transform 0.2s ease;
        }

        .btn svg {
            width: 17px;
            height: 17px;
        }

        .btn-primary {
            color: white;
            background: linear-gradient(135deg, #2563b8, #3478d4);
            box-shadow: 0 5px 13px rgba(37, 99, 184, 0.17);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #1e4f91, #2563b8);
            transform: translateY(-1px);
        }

        /* Audit Table */

        .table-panel {
            padding: 0;
            overflow: hidden;
        }

        .table-panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;

            padding: 23px 25px;

            border-bottom: 1px solid #e9eff7;
        }

        .table-panel-heading .panel-heading {
            margin: 0;
        }

        .table-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-width: 40px;
            min-height: 34px;
            padding: 7px 12px;

            border-radius: 999px;

            color: var(--blue-800);
            background: var(--blue-100);

            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 1120px;
            border-collapse: collapse;
        }

        thead {
            background: #f4f8fe;
        }

        th {
            padding: 15px 16px;

            border-bottom: 1px solid #e3ebf5;

            color: #61738a;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.55px;

            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        td {
            padding: 16px;

            border-bottom: 1px solid #edf2f8;

            color: #40536d;
            font-size: 12px;
            line-height: 1.7;

            text-align: left;
            vertical-align: top;
        }

        tbody tr {
            transition: background 0.15s ease;
        }

        tbody tr:hover {
            background: #f8fbff;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .date-cell {
            color: #526783;
            font-size: 12px;
            white-space: nowrap;
        }

        .action-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 7px 10px;

            border: 1px solid #dce8f8;
            border-radius: 8px;

            color: var(--blue-800);
            background: #edf5ff;

            font-size: 11px;
            font-weight: 800;

            overflow-wrap: anywhere;
        }

        .session-name,
        .section-name,
        .staff-name {
            color: var(--blue-950);
            font-weight: 700;
        }

        .term-badge {
            display: inline-flex;
            padding: 6px 9px;

            border-radius: 7px;

            color: #5b6f88;
            background: #f0f4f9;

            font-size: 11px;
            font-weight: 700;

            white-space: nowrap;
        }

        .count-cell {
            color: var(--blue-800);
            font-size: 13px;
            font-weight: 800;
            text-align: center;
        }

        .details {
            max-width: 380px;

            padding: 12px;

            border: 1px solid #e6edf6;
            border-radius: 10px;

            color: #526783;
            background: #f8fbff;

            font-family: "Courier New", monospace;
            font-size: 11px;
            line-height: 1.7;

            white-space: pre-wrap;
            overflow-wrap: anywhere;
        }

        .details-empty {
            color: #8b98a9;
            font-family: Arial, Helvetica, sans-serif;
            font-style: italic;
        }

        /* Empty State */

        .empty-state {
            padding: 42px 20px;
            text-align: center;
        }

        .empty-state-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 58px;
            height: 58px;

            margin: 0 auto 15px;

            border-radius: 17px;

            color: var(--blue-700);
            background: var(--blue-100);
        }

        .empty-state-icon svg {
            width: 27px;
            height: 27px;
        }

        .empty-state h4 {
            margin: 0;
            color: var(--blue-950);
            font-size: 16px;
        }

        .empty-state p {
            margin: 9px 0 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        /* Pagination */

        .pagination-wrap {
            padding: 20px 25px;
            border-top: 1px solid #edf2f8;
            background: #fcfdff;
        }

        .pagination-wrap nav {
            display: flex;
            justify-content: flex-end;
        }

        .pagination-wrap nav > div {
            max-width: 100%;
        }

        .pagination-wrap svg {
            width: 16px;
            height: 16px;
        }

        /* Footer */

        .page-footer {
            padding: 25px 10px 0;

            color: #8291a5;
            font-size: 12px;
            text-align: center;
        }

        .page-footer strong {
            color: var(--blue-800);
        }

        /* Responsive */

        @media (max-width: 760px) {
            .school-header-inner {
                grid-template-columns: 62px 1fr 62px;
                gap: 10px;
                padding: 17px 12px;
            }

            .school-logo {
                width: 58px;
                height: 58px;
            }

            .school-brand h1 {
                font-size: 19px;
                letter-spacing: -0.4px;
            }

            .school-brand p {
                font-size: 12px;
            }

            .school-tagline {
                margin-top: 8px;
                padding: 5px 9px;
                font-size: 9px;
            }

            .page-container {
                width: calc(100% - 24px);
                margin-top: 22px;
            }

            .welcome-banner {
                padding: 23px 20px;
                border-radius: 16px;
            }

            .panel {
                padding: 19px;
                border-radius: 15px;
            }

            .filters {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .form-actions {
                align-items: stretch;
                flex-direction: column;
            }

            .form-actions .btn {
                width: 100%;
            }

            .table-panel-heading {
                padding: 19px;
            }

            .table-panel-heading .panel-heading p {
                max-width: 230px;
            }

            .pagination-wrap {
                padding: 17px;
            }
        }

        @media (max-width: 420px) {
            .school-header-inner {
                grid-template-columns: 48px 1fr 48px;
                gap: 7px;
            }

            .school-logo {
                width: 46px;
                height: 46px;
            }

            .school-brand h1 {
                font-size: 16px;
            }

            .school-brand p {
                font-size: 11px;
            }

            .school-tagline {
                font-size: 8px;
                letter-spacing: 0.5px;
            }

            .page-heading h2 {
                font-size: 25px;
            }

            .panel-heading h3 {
                font-size: 17px;
            }

            .panel-icon {
                width: 40px;
                height: 40px;
            }

            .table-panel-heading {
                align-items: flex-start;
            }

            .table-count {
                font-size: 10px;
            }
        }
    </style>
</head>

<body>

    {{-- School Header --}}
    <header class="school-header">
        <div class="school-header-inner">

            <img
                src="{{ asset('images/school-logo.jpeg') }}"
                alt="Fatima Nursery and Primary School Logo"
                class="school-logo"
            >

            <div class="school-brand">
                <h1>Fatima Nursery and Primary School</h1>
                <p>Gusau, Zamfara State</p>

                <span class="school-tagline">
                    Diligence & Success
                </span>
            </div>

            <img
                src="{{ asset('images/second-school-logo.jpeg') }}"
                alt="Fatima Nursery and Primary School Second Logo"
                class="school-logo"
            >

        </div>
    </header>

    <main class="page-container">

       

        {{-- Page Heading --}}
        <div class="page-heading">
            <h2>Publication Audit History</h2>

            <p>
                Review publication activity, track result eligibility
                checks, and inspect the history of class and term
                publication actions.
            </p>
        </div>

        {{-- Welcome Banner --}}
        <section class="welcome-banner">
            <div class="welcome-content">


                <h3>Track Result Publication Activity</h3>

                <p>
                    Explore the audit history for academic sessions,
                    class sections, and terms. Review who performed
                    each action, how many pupils were eligible or
                    excluded, and the recorded audit details.
                </p>

            </div>
        </section>
         {{-- Back Navigation --}}
        <a
            href="{{ route('staff-management.index') }}"
            class="back-link"
        >
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
            >
                <path d="m15 18-6-6 6-6"/>
                <path d="M9 12h12"/>
            </svg>

            Back to Staff Management
        </a>

        {{-- Filter Panel --}}
        <section class="panel">

            <div class="panel-heading">

                <div class="panel-icon">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M4 5h16"/>
                        <path d="M4 12h16"/>
                        <path d="M4 19h16"/>
                        <circle cx="8" cy="5" r="2"/>
                        <circle cx="16" cy="12" r="2"/>
                        <circle cx="10" cy="19" r="2"/>
                    </svg>
                </div>

                <div>
                    <h3>Filter Audit Records</h3>

                    <p>
                        Narrow the audit history by academic session,
                        class section, or academic term.
                    </p>
                </div>

            </div>

            <form
                method="GET"
                action="{{ route('staff-management.publication-audits') }}"
            >

                <div class="filters">

                    {{-- Academic Session --}}
                    <div class="form-field">
                        <label for="session_id">
                            Academic Session
                        </label>

                        <select
                            id="session_id"
                            name="session_id"
                        >
                            <option value="">
                                All sessions
                            </option>

                            @foreach ($sessions as $session)
                                <option
                                    value="{{ $session->id }}"
                                    @selected(
                                        request('session_id') == $session->id
                                    )
                                >
                                    {{ $session->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- Class / Section --}}
                    <div class="form-field">
                        <label for="section_id">
                            Class / Section
                        </label>

                        <select
                            id="section_id"
                            name="section_id"
                        >
                            <option value="">
                                All sections
                            </option>

                            @foreach ($sections as $section)
                                <option
                                    value="{{ $section->id }}"
                                    @selected(
                                        request('section_id') == $section->id
                                    )
                                >
                                    {{ $section->classLevel->name }}
                                    — {{ $section->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- Term --}}
                    <div class="form-field">
                        <label for="term">
                            Academic Term
                        </label>

                        <select
                            id="term"
                            name="term"
                        >
                            <option value="">
                                All terms
                            </option>

                            @foreach ($terms as $term)
                                <option
                                    value="{{ $term }}"
                                    @selected(
                                        request('term') === $term
                                    )
                                >
                                    {{ $term }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                </div>

                <div class="form-actions">

                    <div class="filter-note">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 8v5"/>
                            <path d="M12 16h.01"/>
                        </svg>

                        Leave a filter blank to include all records
                        for that category.
                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M4 5h16"/>
                            <path d="M4 12h16"/>
                            <path d="M4 19h16"/>
                            <circle cx="8" cy="5" r="2"/>
                            <circle cx="16" cy="12" r="2"/>
                            <circle cx="10" cy="19" r="2"/>
                        </svg>

                        Apply Filters
                    </button>

                </div>

            </form>

        </section>

        {{-- Audit Records --}}
        <section class="panel table-panel">

            <div class="table-panel-heading">

                <div class="panel-heading">

                    <div class="panel-icon">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M8 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8l-5-5h-3"/>
                            <path d="M14 3v5h5"/>
                            <path d="M8 13h8"/>
                            <path d="M8 17h8"/>
                            <path d="M8 9h2"/>
                        </svg>
                    </div>

                    <div>
                        <h3>Audit Records</h3>

                        <p>
                            Publication actions and recorded eligibility
                            details for the selected filters.
                        </p>
                    </div>

                </div>

                <span class="table-count">
                    Audit History
                </span>

            </div>

            @if ($audits->isEmpty())

                {{-- Empty State --}}
                <div class="empty-state">

                    <div class="empty-state-icon">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M8 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8l-5-5h-3"/>
                            <path d="M14 3v5h5"/>
                            <path d="M8 13h8"/>
                            <path d="M8 17h5"/>
                        </svg>
                    </div>

                    <h4>No Publication Audit Records Found</h4>

                    <p>
                        No audit records match the selected filters.
                        Try another academic session, class section,
                        or term.
                    </p>

                </div>

            @else

                <div class="table-wrap">

                    <table>

                        <thead>
                            <tr>
                                <th>Date / Time</th>
                                <th>Action</th>
                                <th>Session</th>
                                <th>Class / Section</th>
                                <th>Term</th>
                                <th>Performed By</th>
                                <th>Eligible</th>
                                <th>Excluded</th>
                                <th>Details</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($audits as $audit)

                                <tr>

                                    {{-- Date and Time --}}
                                    <td>
                                        <span class="date-cell">
                                            {{ $audit->created_at?->format('Y-m-d H:i:s') }}
                                        </span>
                                    </td>

                                    {{-- Action --}}
                                    <td>
                                        <span class="action-badge">
                                            {{ $audit->action }}
                                        </span>
                                    </td>

                                    {{-- Academic Session --}}
                                    <td>
                                        <span class="session-name">
                                            {{ $audit->academicSession?->name ?? 'Deleted session' }}
                                        </span>
                                    </td>

                                    {{-- Class / Section --}}
                                    <td>
                                        @if ($audit->section)

                                            <span class="section-name">
                                                {{ $audit->section->classLevel?->name }}
                                                — {{ $audit->section->name }}
                                            </span>

                                        @else

                                            <span>
                                                Deleted section
                                            </span>

                                        @endif
                                    </td>

                                    {{-- Term --}}
                                    <td>
                                        <span class="term-badge">
                                            {{ $audit->term }}
                                        </span>
                                    </td>

                                    {{-- Staff --}}
                                    <td>
                                        <span class="staff-name">
                                            {{ $audit->performedBy?->name ?? 'Account unavailable' }}
                                        </span>
                                    </td>

                                    {{-- Eligible --}}
                                    <td class="count-cell">
                                        {{ $audit->eligible_count }}
                                    </td>

                                    {{-- Excluded --}}
                                    <td class="count-cell">
                                        {{ $audit->excluded_count }}
                                    </td>

                                    {{-- Details --}}
                                    <td>
                                        <div class="details">{{ json_encode($audit->details, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</div>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

            {{-- Laravel Pagination --}}
            <div class="pagination-wrap">
                {{ $audits->links() }}
            </div>

        </section>

        {{-- Footer --}}
        <footer class="page-footer">
            <strong>Fatima Nursery and Primary School</strong>
            &nbsp;·&nbsp;
            Gusau, Zamfara State
        </footer>

    </main>

</body>
</html>