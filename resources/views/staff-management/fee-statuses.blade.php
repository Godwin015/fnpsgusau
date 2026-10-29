<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pupil Fee Statuses | FNPS Gusau</title>

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
            width: 130px;
            height: 130px;
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

        /* Back Navigation */

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 25px;
            color: #2563eb;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #123f83;
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
            font-size: 23px;
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

        /* Form */

        .form-intro {
            margin: 0 0 20px;
            color: #718096;
            font-size: 13px;
            line-height: 1.7;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        label {
            display: block;
            margin-top: 17px;
            color: #244777;
            font-size: 13px;
            font-weight: 700;
        }

        select {
            display: block;
            width: 100%;
            min-height: 47px;
            margin-top: 8px;
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

        select:focus {
            border-color: #60a5fa;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
        }

        /* Buttons */

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

        .load-button {
            width: 100%;
            margin-top: 25px;
        }

        /* Fee Overview */

        .fee-overview {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 25px;
        }

        .overview-card {
            padding: 19px;
            border: 1px solid #e2eaf5;
            border-radius: 15px;
            background: #f8faff;
        }

        .overview-label {
            display: block;
            color: #718096;
            font-size: 12px;
            font-weight: 700;
            line-height: 1.6;
        }

        .overview-value {
            display: block;
            margin-top: 8px;
            color: #173f7a;
            font-size: 27px;
            font-weight: 800;
        }

        .overview-card.paid-card {
            background: #f0fdf4;
            border-color: #bbf7d0;
        }

        .overview-card.paid-card .overview-value {
            color: #15803d;
        }

        .overview-card.unpaid-card {
            background: #fff7ed;
            border-color: #fed7aa;
        }

        .overview-card.unpaid-card .overview-value {
            color: #c2410c;
        }

        /* Selection Summary */

        .selection-summary {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
        }

        .selection-label {
            color: #718096;
            font-size: 13px;
            font-weight: 700;
        }

        .selection-badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 20px;
            background: #e8f0ff;
            color: #2453a0;
            font-size: 12px;
            font-weight: 800;
        }

        /* Fee Status Table */

        .table-wrap {
            overflow-x: auto;
            border: 1px solid #e2eaf5;
            border-radius: 13px;
            background: #ffffff;
        }

        table {
            width: 100%;
            min-width: 760px;
            border-collapse: separate;
            border-spacing: 0;
            background: #ffffff;
        }

        th {
            padding: 15px 14px;
            background: #edf4ff;
            color: #244777;
            font-size: 12px;
            font-weight: 800;
            text-align: left;
            white-space: nowrap;
            border-bottom: 1px solid #dbe5f2;
        }

        td {
            padding: 15px 14px;
            color: #52657f;
            font-size: 13px;
            line-height: 1.7;
            border-bottom: 1px solid #edf2f8;
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #f8faff;
        }

        .row-number {
            color: #8290a5;
            font-weight: 700;
        }

        .admission-number {
            color: #2453a0;
            font-weight: 700;
            white-space: nowrap;
        }

        .pupil-name {
            color: #244777;
            font-weight: 700;
            min-width: 170px;
        }

        /* Status Badges */

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .status-badge::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .status-paid {
            background: #dcfce7;
            color: #166534;
        }

        .status-paid::before {
            background: #16a34a;
        }

        .status-unpaid {
            background: #fff1f2;
            color: #b42335;
        }

        .status-unpaid::before {
            background: #e11d48;
        }

        /* Individual Fee Update Form */

        .fee-form {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            min-width: 235px;
        }

        .fee-form select {
            flex: 1;
            min-width: 120px;
            min-height: 40px;
            margin-top: 0;
            padding: 9px 10px;
            font-size: 12px;
        }

        .fee-form .button {
            min-height: 40px;
            padding: 10px 13px;
            font-size: 12px;
        }

        /* Empty State */

        .empty-state {
            padding: 35px 20px;
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
            font-size: 27px;
        }

        .empty-state h3 {
            margin: 0 0 9px;
            color: #244777;
            font-size: 17px;
        }

        .empty-state p {
            margin: 0;
            color: #718096;
            font-size: 13px;
            line-height: 1.8;
        }

        /* Table Information */

        .table-note {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 18px;
            padding: 14px 16px;
            border: 1px solid #dbeafe;
            border-radius: 11px;
            background: #f0f6ff;
            color: #526b91;
            font-size: 12px;
            line-height: 1.8;
        }

        .table-note-icon {
            color: #2563eb;
            font-size: 17px;
            flex-shrink: 0;
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
            .filter-grid {
                grid-template-columns: 1fr;
                gap: 5px;
            }

            .fee-overview {
                grid-template-columns: 1fr;
            }

            .overview-card {
                padding: 16px;
            }

            .overview-value {
                font-size: 24px;
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

            .selection-summary {
                align-items: flex-start;
            }

            .table-note {
                font-size: 11px;
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

    {{-- School Header --}}

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


    {{-- Main Page --}}

    <main class="page-container">


        {{-- Page Heading --}}

        <div class="page-heading">

            <h2>Pupil Fee Management</h2>

            <p>
                View pupil enrolments and manage fee payment statuses
                for each academic session, class and term.
            </p>

        </div>


        {{-- Success Message --}}

        @if (session('success'))

            <div class="message success" role="status">

                {{ session('success') }}

            </div>

        @endif


        {{-- Error Message --}}

        @if (session('error'))

            <div class="message error" role="alert">

                {{ session('error') }}

            </div>

        @endif


        {{-- Validation Errors --}}

        @if ($errors->any())

            <div class="message error" role="alert">

                <strong>Please correct the following:</strong>

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Welcome Banner --}}

        <section class="welcome-banner">

            <h2>Manage Pupil Fee Records</h2>

            <p>
                Select an academic session, class and term to view
                enrolled pupils and update their fee payment status.
                Keep your school fee records organized and accurate
                throughout the academic year.
            </p>

        </section>


        {{-- Back to Staff Management --}}

        <a
            href="{{ route('staff-management.index') }}"
            class="back-link"
        >

            <span aria-hidden="true">←</span>

            Back to Staff Management

        </a>


        {{-- Select Class and Term --}}

        <section class="panel">

            <div class="panel-heading">

                <div class="panel-icon">
                    🎓
                </div>

                <div>

                    <h2>Select Class and Term</h2>

                    <p>
                        Choose the academic session and class
                        whose pupil fee records you want to manage.
                    </p>

                </div>

            </div>


            <p class="form-intro">

                Select all three options below, then load the
                enrolled pupils to view their fee statuses.

            </p>


            <form
                method="GET"
                action="{{ route('staff-management.fee-statuses') }}"
            >

                <div class="filter-grid">


                    {{-- Academic Session --}}

                    <div>

                        <label for="session_id">
                            Academic Session
                        </label>

                        <select
                            id="session_id"
                            name="session_id"
                            required
                        >

                            <option value="">
                                Choose session
                            </option>

                            @foreach ($sessions as $session)

                                <option
                                    value="{{ $session->id }}"
                                    @selected(
                                        (string) $selectedSessionId ===
                                        (string) $session->id
                                    )
                                >

                                    {{ $session->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Class / Section --}}

                    <div>

                        <label for="section_id">
                            Class / Section
                        </label>

                        <select
                            id="section_id"
                            name="section_id"
                            required
                        >

                            <option value="">
                                Choose class / section
                            </option>

                            @foreach ($sections as $section)

                                <option
                                    value="{{ $section->id }}"
                                    @selected(
                                        (string) $selectedSectionId ===
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

                    <div>

                        <label for="term">
                            Academic Term
                        </label>

                        <select
                            id="term"
                            name="term"
                            required
                        >

                            @foreach ($terms as $term)

                                <option
                                    value="{{ $term }}"
                                    @selected($selectedTerm === $term)
                                >

                                    {{ $term }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                </div>


                <button
                    type="submit"
                    class="button button-primary load-button"
                >

                    <span aria-hidden="true">⌕</span>

                    Load Pupils

                </button>

            </form>

        </section>


        {{-- Fee Status Results --}}

        @if ($selectedSessionId && $selectedSectionId)

            <section class="panel">


                {{-- Panel Heading --}}

                <div class="panel-heading">

                    <div class="panel-icon">
                        💳
                    </div>

                    <div>

                        <h2>Fee Status Management</h2>

                        <p>
                            Review pupil fee records and update
                            individual payment statuses.
                        </p>

                    </div>

                </div>


                {{-- Selected Information --}}

                <div class="selection-summary">

                    <span class="selection-label">
                        Selected Term:
                    </span>

                    <span class="selection-badge">

                        {{ $selectedTerm }}

                    </span>

                </div>


                {{-- Default Status Notice --}}

                <div class="table-note">

                    <span class="table-note-icon">
                        ℹ
                    </span>

                    <div>

                        New or unset fee statuses are treated as
                        <strong>Not Paid</strong>
                        until explicitly updated.

                    </div>

                </div>


                {{-- Empty State --}}

                @if ($enrollments->isEmpty())

                    <div class="empty-state">

                        <div class="empty-icon">
                            👨‍🎓
                        </div>

                        <h3>No Pupil Enrolments Found</h3>

                        <p>

                            No active pupil enrolments were found
                            for the selected academic session,
                            class and term.

                            Please check your selection and
                            try again.

                        </p>

                    </div>


                @else


                    {{-- Fee Overview --}}

                    <div class="fee-overview">


                        {{-- Total Pupils --}}

                        <div class="overview-card">

                            <span class="overview-label">
                                Total Enrolled Pupils
                            </span>

                            <span class="overview-value">

                                {{ $enrollments->count() }}

                            </span>

                        </div>


                        {{-- Paid --}}

                        <div class="overview-card paid-card">

                            <span class="overview-label">
                                Fee Status: Paid
                            </span>

                            <span class="overview-value">

                                {{ $enrollments->filter(
                                    fn ($enrollment) =>
                                    $enrollment->feeStatuses->first()?->status
                                    === 'paid'
                                )->count() }}

                            </span>

                        </div>


                        {{-- Not Paid --}}

                        <div class="overview-card unpaid-card">

                            <span class="overview-label">
                                Fee Status: Not Paid
                            </span>

                            <span class="overview-value">

                                {{ $enrollments->filter(
                                    fn ($enrollment) =>
                                    ($enrollment->feeStatuses->first()?->status
                                    ?? 'not_paid') === 'not_paid'
                                )->count() }}

                            </span>

                        </div>


                    </div>


                    {{-- Fee Status Table --}}

                    <div class="table-wrap">

                        <table>

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>Admission Number</th>

                                    <th>Pupil Name</th>

                                    <th>Fee Status</th>

                                    <th>Update Fee Status</th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach ($enrollments as $enrollment)

                                    @php

                                        $feeStatus =
                                            $enrollment->feeStatuses->first();

                                        $currentStatus =
                                            $feeStatus?->status ?? 'not_paid';

                                    @endphp


                                    <tr>


                                        {{-- Row Number --}}

                                        <td class="row-number">

                                            {{ $loop->iteration }}

                                        </td>


                                        {{-- Admission Number --}}

                                        <td class="admission-number">

                                            {{ $enrollment->student->admission_number }}

                                        </td>


                                        {{-- Pupil Name --}}

                                        <td class="pupil-name">

                                            {{ $enrollment->student->last_name }},
                                            {{ $enrollment->student->first_name }}
                                            {{ $enrollment->student->middle_name }}

                                        </td>


                                        {{-- Current Fee Status --}}

                                        <td>

                                            @if ($currentStatus === 'paid')

                                                <span class="status-badge status-paid">

                                                    Paid

                                                </span>

                                            @else

                                                <span class="status-badge status-unpaid">

                                                    Not Paid

                                                </span>

                                            @endif

                                        </td>


                                        {{-- Update Fee Status --}}

                                        <td>

                                            <form
                                                class="fee-form"
                                                method="POST"
                                                action="{{ route(
                                                    'staff-management.fee-statuses.update',
                                                    $enrollment
                                                ) }}"
                                            >

                                                @csrf


                                                {{-- Preserve Academic Session --}}

                                                <input
                                                    type="hidden"
                                                    name="session_id"
                                                    value="{{ $selectedSessionId }}"
                                                >


                                                {{-- Preserve Class / Section --}}

                                                <input
                                                    type="hidden"
                                                    name="section_id"
                                                    value="{{ $selectedSectionId }}"
                                                >


                                                {{-- Preserve Academic Term --}}

                                                <input
                                                    type="hidden"
                                                    name="term"
                                                    value="{{ $selectedTerm }}"
                                                >


                                                {{-- Fee Status --}}

                                                <select
                                                    name="status"
                                                    required
                                                    aria-label="Fee status for {{ $enrollment->student->first_name }}"
                                                >

                                                    <option
                                                        value="not_paid"
                                                        @selected(
                                                            $currentStatus === 'not_paid'
                                                        )
                                                    >

                                                        Not Paid

                                                    </option>

                                                    <option
                                                        value="paid"
                                                        @selected(
                                                            $currentStatus === 'paid'
                                                        )
                                                    >

                                                        Paid

                                                    </option>

                                                </select>


                                                {{-- Save --}}

                                                <button
                                                    type="submit"
                                                    class="button button-primary"
                                                >

                                                    Save

                                                </button>


                                            </form>

                                        </td>


                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- Table Note --}}

                    <div class="table-note">

                        <span class="table-note-icon">
                            ✓
                        </span>

                        <div>

                            Fee status changes are saved individually
                            for the selected academic session and term.

                            Please review the pupil's current status
                            before saving an update.

                        </div>

                    </div>


                @endif


            </section>

        @endif


    </main>


    {{-- Footer --}}

    <footer class="footer">

        &copy; {{ date('Y') }}

        <strong>
            Fatima Nursery and Primary School, Gusau
        </strong>.

        All rights reserved.

    </footer>


</body>
</html>
