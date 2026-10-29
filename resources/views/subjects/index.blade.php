<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Subject Management | FNPS Gusau</title>

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

        button,
        input,
        select {
            font: inherit;
        }

        button {
            cursor: pointer;
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
            width: 88px;
            height: 88px;
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

        .navigation-links {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;

            margin-bottom: 22px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 9px;

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

        .nav-divider {
            color: #bdc9d9;
            font-size: 15px;
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

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
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

        .form-field input[type="text"],
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

        .form-field input:focus,
        .form-field select:focus {
            border-color: var(--blue-600);
            box-shadow: 0 0 0 4px rgba(52, 120, 212, 0.12);
        }

        .form-field input::placeholder {
            color: #9aa8ba;
        }

        .field-hint {
            margin: 8px 0 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        /* Class Level Selection */

        .assignment-section {
            margin-top: 25px;
            padding: 21px;

            border: 1px solid #e2eaf4;
            border-radius: 14px;

            background: #f8fbff;
        }

        .assignment-heading {
            display: flex;
            align-items: flex-start;
            gap: 12px;

            margin-bottom: 17px;
        }

        .assignment-heading-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;
            width: 38px;
            height: 38px;

            border-radius: 11px;

            color: var(--blue-700);
            background: var(--blue-100);
        }

        .assignment-heading-icon svg {
            width: 20px;
            height: 20px;
        }

        .assignment-heading h4 {
            margin: 1px 0 0;
            color: var(--blue-950);
            font-size: 15px;
            font-weight: 800;
        }

        .assignment-heading p {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .class-list {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
        }

        .class-item {
            display: flex;
            align-items: center;
            gap: 10px;

            min-width: 0;
            min-height: 47px;
            padding: 11px 13px;

            border: 1px solid #e0e8f3;
            border-radius: 10px;

            color: #40536d;
            background: white;

            font-size: 13px;
            font-weight: 600;

            cursor: pointer;

            transition:
                border-color 0.2s ease,
                background 0.2s ease;
        }

        .class-item:hover {
            border-color: #b7d1f3;
            background: #f1f7ff;
        }

        .class-item input[type="checkbox"] {
            flex-shrink: 0;

            width: 17px;
            height: 17px;
            margin: 0;

            accent-color: var(--blue-700);
            cursor: pointer;
        }

        .class-item:has(input:checked) {
            border-color: #b7d1f3;
            color: var(--blue-800);
            background: #edf5ff;
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

        .btn-primary:hover {
            background: linear-gradient(135deg, #1e4f91, #2563b8);
            transform: translateY(-1px);
        }

        .btn-secondary {
            color: var(--blue-800);
            background: #edf5ff;
            border-color: #d6e6fa;
        }

        .btn-secondary:hover {
            background: #e1efff;
        }

        /* Existing Subjects */

        .subjects-panel {
            padding: 0;
            overflow: hidden;
        }

        .subjects-panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;

            padding: 23px 25px;

            border-bottom: 1px solid #e9eff7;
        }

        .subjects-panel-heading .panel-heading {
            margin: 0;
        }

        .subject-count {
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

        .subjects-list {
            padding: 0 25px;
        }

        .subject-card {
            padding: 23px 0;
            border-bottom: 1px solid #e9eff7;
        }

        .subject-card:last-child {
            border-bottom: none;
        }

        .subject-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;

            margin-bottom: 14px;
        }

        .subject-title-group {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            min-width: 0;
        }

        .subject-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;
            width: 44px;
            height: 44px;

            border-radius: 12px;

            color: var(--blue-700);
            background: var(--blue-100);
        }

        .subject-icon svg {
            width: 22px;
            height: 22px;
        }

        .subject-title {
            margin: 1px 0 0;
            color: var(--blue-950);

            font-size: 17px;
            font-weight: 800;
            line-height: 1.5;

            overflow-wrap: anywhere;
        }

        .subject-code {
            display: inline-flex;
            align-items: center;

            margin-top: 6px;
            padding: 5px 9px;

            border-radius: 7px;

            color: #61738a;
            background: #f0f4f9;

            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.4px;
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

        .status-active {
            color: var(--green);
            background: var(--green-bg);
        }

        .status-inactive {
            color: var(--red);
            background: var(--red-bg);
        }

        .assigned-levels {
            display: flex;
            align-items: flex-start;
            gap: 10px;

            margin: 15px 0 18px;
        }

        .assigned-label {
            flex-shrink: 0;
            padding-top: 4px;

            color: #718096;
            font-size: 12px;
            font-weight: 700;
        }

        .assigned-list {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }

        .level-badge {
            display: inline-flex;
            align-items: center;

            padding: 6px 9px;

            border: 1px solid #dce8f8;
            border-radius: 8px;

            color: var(--blue-800);
            background: #edf5ff;

            font-size: 11px;
            font-weight: 700;
        }

        .no-levels {
            color: #8b98a9;
            font-size: 12px;
            font-style: italic;
        }

        /* Edit Details */

        .edit-details {
            margin-top: 17px;

            border: 1px solid #e0eaf5;
            border-radius: 13px;

            background: #fbfdff;

            overflow: hidden;
        }

        .edit-details summary {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;

            padding: 15px 17px;

            color: var(--blue-800);
            background: #f3f8ff;

            font-size: 13px;
            font-weight: 800;

            cursor: pointer;
            list-style: none;
        }

        .edit-details summary::-webkit-details-marker {
            display: none;
        }

        .edit-details summary::after {
            content: "+";

            display: flex;
            align-items: center;
            justify-content: center;

            width: 25px;
            height: 25px;

            border-radius: 7px;

            color: var(--blue-700);
            background: #e3efff;

            font-size: 18px;
            font-weight: 600;
        }

        .edit-details[open] summary::after {
            content: "−";
        }

        .edit-form {
            padding: 20px;
            border-top: 1px solid #e6edf6;
        }

        .edit-form .form-grid {
            gap: 17px;
        }

        .edit-form .assignment-section {
            margin-top: 21px;
        }

        .edit-form .class-list {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .edit-form .form-actions {
            gap: 10px;
        }

        /* Empty State */

        .empty-state {
            padding: 45px 20px;
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

            .form-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .class-list,
            .edit-form .class-list {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .form-actions {
                align-items: stretch;
            }

            .form-actions .btn {
                width: 100%;
            }

            .subjects-panel-heading {
                padding: 19px;
            }

            .subjects-list {
                padding: 0 19px;
            }

            .subject-card-header {
                flex-wrap: wrap;
            }

            .assigned-levels {
                flex-direction: column;
                gap: 8px;
            }

            .edit-form {
                padding: 17px;
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

            .class-list,
            .edit-form .class-list {
                grid-template-columns: 1fr;
            }

            .subjects-panel-heading {
                align-items: flex-start;
            }

            .subject-title {
                font-size: 15px;
            }

            .subject-card-header {
                gap: 10px;
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

        {{-- Navigation --}}
        <nav class="navigation-links">

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

        </nav>

        {{-- Page Heading --}}
        <div class="page-heading">
            <h2>Subject Management</h2>

            <p>
                Create subjects, assign them to class levels,
                and manage existing subject details and status.
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
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                        <path d="M8 7h8"/>
                        <path d="M8 11h8"/>
                    </svg>

                    Academic Administration
                </span>

                <h3>Manage School Subjects</h3>

                <p>
                    Organize the subjects taught across your school.
                    Create subject records, assign class levels,
                    and maintain existing subject information
                    from one convenient page.
                </p>

            </div>
        </section>

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
                    <circle cx="12" cy="12" r="10"/>
                    <path d="m8 12 3 3 5-6"/>
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
                    <strong>Please correct the following errors:</strong>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>

        @endif

        {{-- Create Subject --}}
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
                        <path d="M12 5v14"/>
                        <path d="M5 12h14"/>
                        <circle cx="12" cy="12" r="9"/>
                    </svg>
                </div>

                <div>
                    <h3>Create a Subject</h3>

                    <p>
                        Enter the subject name and code,
                        then select the class levels that
                        study this subject.
                    </p>
                </div>

            </div>

            <form
                method="POST"
                action="{{ route('subjects.store') }}"
            >
                @csrf

                <div class="form-grid">

                    {{-- Subject Name --}}
                    <div class="form-field">

                        <label for="create_subject_name">
                            Subject Name
                        </label>

                        <input
                            type="text"
                            id="create_subject_name"
                            name="name"
                            value="{{ old('name') }}"
                            maxlength="100"
                            placeholder="e.g. Mathematics"
                            required
                        >

                        <p class="field-hint">
                            Enter the full subject name.
                        </p>

                    </div>

                    {{-- Subject Code --}}
                    <div class="form-field">

                        <label for="create_subject_code">
                            Subject Code
                        </label>

                        <input
                            type="text"
                            id="create_subject_code"
                            name="code"
                            value="{{ old('code') }}"
                            maxlength="30"
                            placeholder="e.g. MATH"
                            required
                        >

                        <p class="field-hint">
                            Use the subject's unique code.
                        </p>

                    </div>

                </div>

                {{-- Class Level Assignments --}}
                <div class="assignment-section">

                    <div class="assignment-heading">

                        <div class="assignment-heading-icon">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >
                                <path d="M3 5h18"/>
                                <path d="M3 12h18"/>
                                <path d="M3 19h18"/>
                                <circle cx="8" cy="5" r="2"/>
                                <circle cx="16" cy="12" r="2"/>
                                <circle cx="10" cy="19" r="2"/>
                            </svg>
                        </div>

                        <div>
                            <h4>Assign to Class Levels</h4>

                            <p>
                                Select every class level that
                                studies this subject.
                            </p>
                        </div>

                    </div>

                    <div class="class-list">

                        @foreach ($classLevels as $classLevel)

                            <label class="class-item">

                                <input
                                    type="checkbox"
                                    name="class_level_ids[]"
                                    value="{{ $classLevel->id }}"
                                    @checked(in_array(
                                        (string) $classLevel->id,
                                        array_map(
                                            'strval',
                                            old('class_level_ids', [])
                                        )
                                    ))
                                >

                                <span>
                                    {{ $classLevel->name }}
                                </span>

                            </label>

                        @endforeach

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
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M12 5v14"/>
                            <path d="M5 12h14"/>
                        </svg>

                        Create Subject
                    </button>

                </div>

            </form>

        </section>

        {{-- Existing Subjects --}}
        <section class="panel subjects-panel">

            <div class="subjects-panel-heading">

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
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                            <path d="M8 7h8"/>
                            <path d="M8 11h8"/>
                        </svg>
                    </div>

                    <div>
                        <h3>Existing Subjects</h3>

                        <p>
                            Review subject assignments,
                            update details, or change status.
                        </p>
                    </div>

                </div>

                <span class="subject-count">
                    Subjects
                </span>

            </div>

            @forelse ($subjects as $subject)

                <div class="subjects-list">

                    <article class="subject-card">

                        {{-- Subject Header --}}
                        <div class="subject-card-header">

                            <div class="subject-title-group">

                                <div class="subject-icon">
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        aria-hidden="true"
                                    >
                                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                                        <path d="M8 7h8"/>
                                        <path d="M8 11h8"/>
                                    </svg>
                                </div>

                                <div>

                                    <h4 class="subject-title">
                                        {{ $subject->name }}
                                    </h4>

                                    <span class="subject-code">
                                        {{ $subject->code }}
                                    </span>

                                </div>

                            </div>

                            @if ($subject->is_active)

                                <span class="status-badge status-active">
                                    Active
                                </span>

                            @else

                                <span class="status-badge status-inactive">
                                    Inactive
                                </span>

                            @endif

                        </div>

                        {{-- Assigned Class Levels --}}
                        <div class="assigned-levels">

                            <span class="assigned-label">
                                Assigned Class Levels:
                            </span>

                            <div class="assigned-list">

                                @forelse ($subject->classLevels as $classLevel)

                                    <span class="level-badge">
                                        {{ $classLevel->name }}
                                    </span>

                                @empty

                                    <span class="no-levels">
                                        None assigned
                                    </span>

                                @endforelse

                            </div>

                        </div>

                        {{-- Edit Subject --}}
                        <details class="edit-details">

                            <summary>
                                Edit Subject and Assignments
                            </summary>

                            <div class="edit-form">

                                <form
                                    method="POST"
                                    action="{{ route('subjects.update', $subject) }}"
                                >
                                    @csrf
                                    @method('PUT')

                                    <div class="form-grid">

                                        {{-- Edit Name --}}
                                        <div class="form-field">

                                            <label for="subject_name_{{ $subject->id }}">
                                                Subject Name
                                            </label>

                                            <input
                                                type="text"
                                                id="subject_name_{{ $subject->id }}"
                                                name="name"
                                                value="{{ $subject->name }}"
                                                maxlength="100"
                                                required
                                            >

                                        </div>

                                        {{-- Edit Code --}}
                                        <div class="form-field">

                                            <label for="subject_code_{{ $subject->id }}">
                                                Subject Code
                                            </label>

                                            <input
                                                type="text"
                                                id="subject_code_{{ $subject->id }}"
                                                name="code"
                                                value="{{ $subject->code }}"
                                                maxlength="30"
                                                required
                                            >

                                        </div>

                                        {{-- Status --}}
                                        <div class="form-field">

                                            <label for="subject_status_{{ $subject->id }}">
                                                Subject Status
                                            </label>

                                            <select
                                                id="subject_status_{{ $subject->id }}"
                                                name="is_active"
                                                required
                                            >

                                                <option
                                                    value="1"
                                                    @selected($subject->is_active)
                                                >
                                                    Active
                                                </option>

                                                <option
                                                    value="0"
                                                    @selected(!$subject->is_active)
                                                >
                                                    Inactive
                                                </option>

                                            </select>

                                        </div>

                                    </div>

                                    {{-- Class Level Assignments --}}
                                    <div class="assignment-section">

                                        <div class="assignment-heading">

                                            <div class="assignment-heading-icon">
                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    aria-hidden="true"
                                                >
                                                    <path d="M3 5h18"/>
                                                    <path d="M3 12h18"/>
                                                    <path d="M3 19h18"/>
                                                    <circle cx="8" cy="5" r="2"/>
                                                    <circle cx="16" cy="12" r="2"/>
                                                    <circle cx="10" cy="19" r="2"/>
                                                </svg>
                                            </div>

                                            <div>
                                                <h4>Class Level Assignments</h4>

                                                <p>
                                                    Select the class levels
                                                    assigned to this subject.
                                                </p>
                                            </div>

                                        </div>

                                        <div class="class-list">

                                            @foreach ($classLevels as $classLevel)

                                                <label class="class-item">

                                                    <input
                                                        type="checkbox"
                                                        name="class_level_ids[]"
                                                        value="{{ $classLevel->id }}"
                                                        @checked(
                                                            $subject->classLevels->contains(
                                                                'id',
                                                                $classLevel->id
                                                            )
                                                        )
                                                    >

                                                    <span>
                                                        {{ $classLevel->name }}
                                                    </span>

                                                </label>

                                            @endforeach

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
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                aria-hidden="true"
                                            >
                                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z"/>
                                                <path d="M17 21v-8H7v8"/>
                                                <path d="M7 3v5h8"/>
                                            </svg>

                                            Save Changes
                                        </button>

                                    </div>

                                </form>

                            </div>

                        </details>

                    </article>

                </div>

            @empty

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
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                            <path d="M8 7h8"/>
                            <path d="M8 11h8"/>
                        </svg>
                    </div>

                    <h4>No Subjects Created Yet</h4>

                    <p>
                        Create your first subject using the form above.
                        It will appear here once it has been created.
                    </p>

                </div>

            @endforelse

            {{-- Pagination --}}
            <div class="pagination-wrap">
                {{ $subjects->links() }}
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