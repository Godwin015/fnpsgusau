<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Class Result Publication | FNPS Gusau</title>

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

            --red: #b42336;
            --red-bg: #fff0f1;

            --amber: #946200;
            --amber-bg: #fff8e8;

            --shadow:
                0 12px 35px rgba(25, 65, 120, 0.08);
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

        button,
        select {
            font: inherit;
        }

        button {
            cursor: pointer;
        }

        button:disabled {
            cursor: not-allowed;
            opacity: 0.55;
        }

        /* School header */

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
            width: 88px;
            height: 88px;
            object-fit: contain;
            display: block;
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

        .school-brand .school-tagline {
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

        /* Main page */

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

        /* Welcome banner */

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

        /* Alerts */

        .alert {
            display: flex;
            align-items: flex-start;
            gap: 12px;

            margin-bottom: 22px;
            padding: 16px 18px;

            border: 1px solid;
            border-radius: 13px;

            font-size: 14px;
            line-height: 1.7;
        }

        .alert svg {
            flex-shrink: 0;
            width: 20px;
            height: 20px;
            margin-top: 1px;
        }

        .alert-success {
            color: var(--green);
            background: var(--green-bg);
            border-color: #c8ead6;
        }

        .alert-error {
            color: var(--red);
            background: var(--red-bg);
            border-color: #f3c9ce;
        }

        .alert-warning {
            color: var(--amber);
            background: var(--amber-bg);
            border-color: #f0dfb1;
        }

        .alert ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        .alert li + li {
            margin-top: 4px;
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

        /* Form */

        .selection-grid {
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

        .form-field select:invalid {
            color: #8996a8;
        }

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;

            margin-top: 23px;
            padding-top: 20px;

            border-top: 1px solid #edf2f8;
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

        .btn-primary:hover:not(:disabled) {
            background: linear-gradient(135deg, #1e4f91, #2563b8);
            transform: translateY(-1px);
        }

        .btn-success {
            color: white;
            background: #16804f;
            box-shadow: 0 5px 13px rgba(22, 128, 79, 0.14);
        }

        .btn-success:hover:not(:disabled) {
            background: #116b41;
            transform: translateY(-1px);
        }

        .btn-danger {
            color: #a61b2b;
            background: #fff1f2;
            border-color: #f1c9ce;
        }

        .btn-danger:hover:not(:disabled) {
            background: #ffe3e6;
        }

        /* Readiness summary */

        .readiness-summary {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 15px;

            margin-bottom: 22px;
        }

        .summary-card {
            min-width: 0;
            padding: 17px 18px;

            border: 1px solid #e4edf8;
            border-radius: 14px;

            background: linear-gradient(145deg, #f8fbff, #eef5ff);
        }

        .summary-label {
            display: block;
            margin-bottom: 9px;

            color: #718096;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.7px;
            text-transform: uppercase;
        }

        .summary-value {
            display: block;
            color: var(--blue-950);
            font-size: 25px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .summary-description {
            display: block;
            margin-top: 7px;

            color: #73839a;
            font-size: 12px;
            line-height: 1.5;
        }

        /* Publication status */

        .publication-status {
            display: flex;
            align-items: center;
            gap: 10px;

            margin-bottom: 20px;
            padding: 14px 16px;

            border: 1px solid #e0eaf5;
            border-radius: 12px;

            background: #f8fbff;

            font-size: 13px;
            line-height: 1.6;
        }

        .publication-status svg {
            flex-shrink: 0;
            width: 20px;
            height: 20px;
        }

        .publication-status.published {
            color: var(--green);
            border-color: #c9e9d7;
            background: var(--green-bg);
        }

        .publication-status.unpublished {
            color: #61738a;
        }

        .publication-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;

            padding-top: 20px;
            border-top: 1px solid #edf2f8;
        }

        .publication-actions form {
            margin: 0;
        }

        .publication-note {
            margin: 17px 0 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        /* Table */

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
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 720px;
        }

        thead {
            background: #f4f8fe;
        }

        th {
            padding: 15px 18px;

            border-bottom: 1px solid #e3ebf5;

            color: #61738a;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.65px;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        td {
            padding: 16px 18px;

            border-bottom: 1px solid #edf2f8;

            color: #40536d;
            font-size: 13px;
            vertical-align: middle;
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

        .pupil-name {
            color: var(--blue-950);
            font-weight: 800;
        }

        .admission-number {
            color: #687b94;
            font-size: 12px;
            font-weight: 700;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            padding: 7px 10px;

            border-radius: 999px;

            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .status-badge::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .status-paid {
            color: #16794b;
            background: #eaf8f0;
        }

        .status-unpaid {
            color: #b42336;
            background: #fff0f1;
        }

        .completion-count {
            color: var(--blue-800);
            font-weight: 800;
            white-space: nowrap;
        }

        .empty-state {
            padding: 35px 20px;
            text-align: center;
        }

        .empty-state-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 54px;
            height: 54px;

            margin: 0 auto 13px;

            border-radius: 16px;

            color: var(--blue-700);
            background: var(--blue-100);
        }

        .empty-state-icon svg {
            width: 25px;
            height: 25px;
        }

        .empty-state h4 {
            margin: 0;
            color: var(--blue-950);
            font-size: 15px;
        }

        .empty-state p {
            margin: 8px 0 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
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

            .school-brand .school-tagline {
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

            .selection-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .readiness-summary {
                grid-template-columns: 1fr;
                gap: 11px;
            }

            .summary-card {
                padding: 15px;
            }

            .summary-value {
                font-size: 22px;
            }

            .table-panel-heading {
                padding: 19px;
            }

            .publication-actions {
                align-items: stretch;
                flex-direction: column;
            }

            .publication-actions form,
            .publication-actions .btn {
                width: 100%;
            }

            .form-actions .btn {
                width: 100%;
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

            .school-brand .school-tagline {
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
                    Academic Excellence and Integrity
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
            <h2>Class Result Publication</h2>

            <p>
                Manage class result publication, review pupil eligibility,
                and control the availability of termly results.
            </p>
        </div>

        {{-- Welcome Banner --}}
        <section class="welcome-banner">
            <div class="welcome-content">

                <span class="welcome-label">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M12 3 20 7v5c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7l8-4Z"/>
                        <path d="m9 12 2 2 4-4"/>
                    </svg>

                    Results Administration
                </span>

                <h3>Manage Class and Term Publication</h3>

                <p>
                    Select an academic session, class, and term to review
                    publication readiness. The system checks fee status
                    and submitted subject results before eligible results
                    can be published.
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

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <path d="m5 12 4 4L19 6"/>
                    <circle cx="12" cy="12" r="10"/>
                </svg>

                <div>
                    <strong>Successful</strong>
                    <div>{{ session('success') }}</div>
                </div>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-error">
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

                <div>
                    <strong>Please correct the following:</strong>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- Selection Panel --}}
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
                    <h3>Select Class and Term</h3>

                    <p>
                        Choose the academic session, class section,
                        and term you want to manage.
                    </p>
                </div>

            </div>

            <form
                method="GET"
                action="{{ route('staff-management.class-term-publication') }}"
            >

                <div class="selection-grid">

                    {{-- Academic Session --}}
                    <div class="form-field">
                        <label for="session_id">
                            Academic Session
                        </label>

                        <select
                            id="session_id"
                            name="session_id"
                            required
                        >
                            <option value="">
                                Select academic session
                            </option>

                            @foreach ($sessions as $session)
                                <option
                                    value="{{ $session->id }}"
                                    @selected(
                                        (string) $selectedSessionId
                                        ===
                                        (string) $session->id
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
                            required
                        >
                            <option value="">
                                Select class and section
                            </option>

                            @foreach ($sections as $section)
                                <option
                                    value="{{ $section->id }}"
                                    @selected(
                                        (string) $selectedSectionId
                                        ===
                                        (string) $section->id
                                    )
                                >
                                    {{ $section->classLevel->name }}
                                    — {{ $section->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- Academic Term --}}
                    <div class="form-field">
                        <label for="term">
                            Academic Term
                        </label>

                        <select
                            id="term"
                            name="term"
                            required
                        >
                            @foreach ($terms as $termOption)
                                <option
                                    value="{{ $termOption }}"
                                    @selected(
                                        $selectedTerm === $termOption
                                    )
                                >
                                    {{ $termOption }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                </div>

                <div class="form-actions">
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path d="M5 12h14"/>
                            <path d="m13 6 6 6-6 6"/>
                        </svg>

                        Load Class
                    </button>
                </div>

            </form>

        </section>

        {{-- Publication Readiness and Eligibility --}}
        @if ($selectedSessionId && $selectedSectionId)

            {{-- Publication Readiness --}}
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
                            <path d="M9 11 12 14 22 4"/>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                        </svg>
                    </div>

                    <div>
                        <h3>Publication Readiness</h3>

                        <p>
                            Review the required subjects and current
                            publication status before taking action.
                        </p>
                    </div>

                </div>

                {{-- Readiness Summary --}}
                <div class="readiness-summary">

                    <div class="summary-card">
                        <span class="summary-label">
                            Required Active Subjects
                        </span>

                        <span class="summary-value">
                            {{ $requiredSubjects->count() }}
                        </span>

                        <span class="summary-description">
                            Subjects assigned to this class level
                        </span>
                    </div>

                    <div class="summary-card">
                        <span class="summary-label">
                            Enrolled Pupils
                        </span>

                        <span class="summary-value">
                            {{ $enrollments->count() }}
                        </span>

                        <span class="summary-description">
                            Active pupil records in this selection
                        </span>
                    </div>

                    <div class="summary-card">
                        <span class="summary-label">
                            Publication Status
                        </span>

                        <span class="summary-value">
                            {{ $publication?->is_published
                                ? 'Published'
                                : 'Unpublished' }}
                        </span>

                        <span class="summary-description">
                            Current class and term status
                        </span>
                    </div>

                </div>

                {{-- No Active Subjects --}}
                @if ($requiredSubjects->isEmpty())

                    <div class="alert alert-warning">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M12 9v4"/>
                            <path d="M12 17h.01"/>
                            <path d="M10.3 3.9 1.8 19a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3l-8.5-15.1a2 2 0 0 0-3.4 0Z"/>
                        </svg>

                        <div>
                            <strong>Subjects Required</strong>

                            <div>
                                No active subjects are assigned to this
                                class level. Assign subjects before
                                publishing results.
                            </div>
                        </div>
                    </div>

                @else

                    <div class="alert alert-warning">
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

                        <div>
                            <strong>Eligibility Requirements</strong>

                            <div>
                                Each pupil's fee status is checked.
                                Every required subject must have a
                                submitted result with First Assessment,
                                Second Assessment, and Exam scores.
                            </div>
                        </div>
                    </div>

                @endif

                {{-- Current Publication Status --}}
                @if ($publication?->is_published)

                    <div class="publication-status published">
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
                            <path d="m8 12 3 3 5-6"/>
                        </svg>

                        <div>
                            <strong>Currently Published</strong>

                            <div>
                                This class and term are marked Published.
                                Re-publishing will re-check eligibility.
                            </div>
                        </div>
                    </div>

                @else

                    <div class="publication-status unpublished">
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
                            <path d="M12 8v4"/>
                            <path d="M12 16h.01"/>
                        </svg>

                        <div>
                            <strong>Currently Unpublished</strong>

                            <div>
                                Results for this class and term are
                                currently marked Unpublished.
                            </div>
                        </div>
                    </div>

                @endif

                {{-- Publish --}}
                <div class="publication-actions">

                    <form
                        method="POST"
                        action="{{ route('staff-management.class-term-publication.publish') }}"
                        onsubmit="return confirm('Check eligibility and publish results for this class and term?');"
                    >
                        @csrf

                        <input
                            type="hidden"
                            name="session_id"
                            value="{{ $selectedSessionId }}"
                        >

                        <input
                            type="hidden"
                            name="section_id"
                            value="{{ $selectedSectionId }}"
                        >

                        <input
                            type="hidden"
                            name="term"
                            value="{{ $selectedTerm }}"
                        >

                        <button
                            type="submit"
                            class="btn btn-success"
                            @disabled(
                                $requiredSubjects->isEmpty()
                                ||
                                $enrollments->isEmpty()
                            )
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
                                <path d="m5 12 4 4L19 6"/>
                                <circle cx="12" cy="12" r="10"/>
                            </svg>

                            Publish Eligible Results
                        </button>
                    </form>

                    {{-- Unpublish --}}
                    @if ($publication?->is_published)

                        <form
                            method="POST"
                            action="{{ route('staff-management.class-term-publication.unpublish') }}"
                            onsubmit="return confirm('Unpublish results for this entire class and term?');"
                        >
                            @csrf

                            <input
                                type="hidden"
                                name="session_id"
                                value="{{ $selectedSessionId }}"
                            >

                            <input
                                type="hidden"
                                name="section_id"
                                value="{{ $selectedSectionId }}"
                            >

                            <input
                                type="hidden"
                                name="term"
                                value="{{ $selectedTerm }}"
                            >

                            <button
                                type="submit"
                                class="btn btn-danger"
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
                                    <circle cx="12" cy="12" r="10"/>
                                    <path d="M8 12h8"/>
                                </svg>

                                Unpublish This Class and Term
                            </button>
                        </form>

                    @endif

                </div>

                <p class="publication-note">
                    Publishing checks pupil eligibility. Review the
                    preview below before publishing or unpublishing
                    the selected class and term.
                </p>

            </section>

            {{-- Pupil Eligibility Preview --}}
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
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M20 8v6"/>
                                <path d="M23 11h-6"/>
                            </svg>
                        </div>

                        <div>
                            <h3>Pupil Eligibility Preview</h3>

                            <p>
                                Review fee status and submitted
                                subject-result completeness.
                            </p>
                        </div>

                    </div>

                    <span class="table-count">
                        {{ $enrollments->count() }} Pupils
                    </span>

                </div>

                @if ($enrollments->isEmpty())

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
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                            </svg>
                        </div>

                        <h4>No Enrolled Pupils Found</h4>

                        <p>
                            No enrolled pupils with active student
                            records were found for this selection.
                        </p>

                    </div>

                @else

                    <div class="table-responsive">

                        <table>

                            <thead>
                                <tr>
                                    <th>Pupil</th>
                                    <th>Admission Number</th>
                                    <th>Fee Status</th>
                                    <th>Required Subjects</th>
                                    <th>Complete and Submitted</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($enrollments as $enrollment)

                                    @php
                                        $feeStatus = $enrollment->feeStatuses->first()?->status
                                            ?? 'not_paid';

                                        $resultsBySubject = $enrollment->studentResults
                                            ->keyBy('subject_id');

                                        $completeCount = 0;

                                        foreach ($requiredSubjects as $subject) {
                                            $result = $resultsBySubject->get($subject->id);

                                            if (
                                                $result
                                                && $result->status === 'submitted'
                                                && $result->first_assessment !== null
                                                && $result->second_assessment !== null
                                                && $result->exam !== null
                                            ) {
                                                $completeCount++;
                                            }
                                        }
                                    @endphp

                                    <tr>

                                        {{-- Pupil --}}
                                        <td>
                                            <span class="pupil-name">
                                                {{ $enrollment->student->first_name }}
                                                {{ $enrollment->student->last_name }}
                                            </span>
                                        </td>

                                        {{-- Admission Number --}}
                                        <td>
                                            <span class="admission-number">
                                                {{ $enrollment->student->admission_number }}
                                            </span>
                                        </td>

                                        {{-- Fee Status --}}
                                        <td>
                                            @if ($feeStatus === 'paid')

                                                <span class="status-badge status-paid">
                                                    Paid
                                                </span>

                                            @else

                                                <span class="status-badge status-unpaid">
                                                    Not Paid
                                                </span>

                                            @endif
                                        </td>

                                        {{-- Required Subjects --}}
                                        <td>
                                            {{ $requiredSubjects->count() }}
                                        </td>

                                        {{-- Complete Results --}}
                                        <td>
                                            <span class="completion-count">
                                                {{ $completeCount }}
                                                /
                                                {{ $requiredSubjects->count() }}
                                            </span>
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @endif

            </section>

        @endif

        {{-- Footer --}}
        <footer class="page-footer">
            <strong>Fatima Nursery and Primary School</strong>
            &nbsp;·&nbsp;
            Gusau, Zamfara State
        </footer>

    </main>

</body>
</html>