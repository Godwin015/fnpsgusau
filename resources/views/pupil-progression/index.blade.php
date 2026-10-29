<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pupil Progression | FNPS Gusau</title>

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

        /* Navigation */

        .navigation {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 28px;
        }

        .back-link,
        .audit-link {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 11px 15px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.2s, transform 0.2s;
        }

        .back-link {
            background: #ffffff;
            border: 1px solid #dbe5f2;
            color: #2453a0;
        }

        .back-link:hover {
            background: #edf4ff;
            transform: translateY(-1px);
        }

        .audit-link {
            background: #e8f0ff;
            border: 1px solid #dbeafe;
            color: #2563eb;
        }

        .audit-link:hover {
            background: #dbeafe;
            transform: translateY(-1px);
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
            line-height: 1.4;
        }

        .page-heading p {
            margin: 10px 0 0;
            color: #718096;
            font-size: 15px;
            line-height: 1.8;
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
            max-width: 750px;
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
            line-height: 1.6;
        }

        /* Form */

        .form-intro {
            margin: 0 0 23px;
            color: #718096;
            font-size: 13px;
            line-height: 1.8;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .form-field {
            min-width: 0;
        }

        .form-field.full-width {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #244777;
            font-size: 13px;
            font-weight: 700;
        }

        input[type="text"],
        select,
        textarea {
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

        select {
            cursor: pointer;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
            line-height: 1.7;
        }

        input[type="text"]:focus,
        select:focus,
        textarea:focus {
            border-color: #60a5fa;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
        }

        .field-help {
            margin: 8px 0 0;
            color: #8290a5;
            font-size: 12px;
            line-height: 1.7;
        }

        /* Movement Action */

        .action-field {
            padding: 17px;
            border: 1px solid #dbeafe;
            border-radius: 13px;
            background: #f0f6ff;
        }

        .action-field select {
            background: #ffffff;
            border-color: #cbdcf5;
        }

        /* Movement Rules */

        .rules-box {
            margin-top: 25px;
            padding: 17px 19px;
            border: 1px solid #dbeafe;
            border-radius: 13px;
            background: #f8faff;
        }

        .rules-box h3 {
            margin: 0 0 10px;
            color: #2453a0;
            font-size: 14px;
            font-weight: 800;
        }

        .rules-box ul {
            margin: 0;
            padding-left: 20px;
            color: #718096;
            font-size: 12px;
            line-height: 1.9;
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

        .button-danger {
            background: #fff1f2;
            border-color: #fecaca;
            color: #b42335;
        }

        .button-danger:hover {
            background: #ffe4e6;
            transform: translateY(-1px);
        }

        .process-button {
            width: 100%;
            min-height: 50px;
            margin-top: 25px;
        }

        /* History Header */

        .history-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 22px;
        }

        .history-heading .panel-heading {
            margin-bottom: 0;
        }

        .history-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            height: 32px;
            padding: 0 10px;
            border-radius: 9px;
            background: #e8f0ff;
            color: #2563eb;
            font-size: 12px;
            font-weight: 800;
            flex-shrink: 0;
        }

        /* Table */

        .table-wrap {
            width: 100%;
            overflow-x: auto;
            border: 1px solid #e2eaf5;
            border-radius: 13px;
        }

        table {
            width: 100%;
            min-width: 700px;
            border-collapse: collapse;
            background: #ffffff;
        }

        thead {
            background: #edf4ff;
        }

        th {
            padding: 15px 16px;
            color: #2453a0;
            font-size: 12px;
            font-weight: 800;
            text-align: left;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            white-space: nowrap;
        }

        td {
            padding: 17px 16px;
            border-bottom: 1px solid #e8eef7;
            color: #44546a;
            font-size: 13px;
            line-height: 1.7;
            text-align: left;
            vertical-align: top;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #f8faff;
        }

        .admission-number {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 7px;
            background: #edf4ff;
            color: #2453a0;
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .pupil-name {
            color: #1e4580;
            font-weight: 800;
            line-height: 1.7;
        }

        .history-item {
            padding: 12px 0;
            border-bottom: 1px solid #e8eef7;
        }

        .history-item:first-child {
            padding-top: 0;
        }

        .history-item:last-child {
            padding-bottom: 0;
            border-bottom: none;
        }

        .history-class {
            display: block;
            color: #1e4580;
            font-size: 13px;
            font-weight: 800;
        }

        .history-session {
            display: block;
            margin-top: 4px;
            color: #718096;
            font-size: 12px;
        }

        .history-status {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 9px;
        }

        .status-label {
            display: inline-flex;
            align-items: center;
            padding: 5px 8px;
            border-radius: 7px;
            background: #f0f6ff;
            color: #45638f;
            font-size: 10px;
            font-weight: 700;
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
            margin: 0;
            color: #718096;
            font-size: 13px;
            line-height: 1.8;
        }

        /* Pagination */

        .pagination-area {
            margin-top: 22px;
            overflow-x: auto;
        }

        .pagination-area nav {
            display: flex;
            justify-content: center;
        }

        .pagination-area svg {
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

        @media (max-width: 800px) {
            .page-container {
                padding: 28px 18px 40px;
            }

            .page-heading h2 {
                font-size: 26px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 19px;
            }

            .form-field.full-width {
                grid-column: auto;
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
                padding: 24px 15px 35px;
            }

            .navigation {
                gap: 9px;
            }

            .back-link,
            .audit-link {
                padding: 10px 12px;
                font-size: 12px;
            }

            .page-heading h2 {
                font-size: 23px;
            }

            .welcome-banner {
                padding: 23px;
                border-radius: 16px;
            }

            .welcome-banner h2 {
                font-size: 21px;
            }

            .panel {
                padding: 19px;
                border-radius: 16px;
            }

            .panel-heading h2 {
                font-size: 18px;
            }

            .history-heading {
                align-items: flex-start;
            }

            .history-count {
                margin-top: 7px;
            }

            .rules-box {
                padding: 15px;
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
                padding: 15px;
            }

            .welcome-banner {
                padding: 19px;
            }

            .navigation {
                flex-direction: column;
                align-items: stretch;
            }

            .back-link,
            .audit-link {
                justify-content: center;
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

            <h2>Pupil Progression Management</h2>

            <p>
                Manage pupil promotion, repetition, demotion and transfers
                between classes and academic sessions.
            </p>
            

        </div>

        <!-- Success Message -->

        @if (session('success'))

            <div class="message success" role="status">
                {{ session('success') }}
            </div>

        @endif

        <!-- Validation Errors -->

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

        <!-- Welcome Banner -->

        <section class="welcome-banner">

            <h2>Manage Pupil Academic Progress</h2>

            <p>
                Process pupil movements carefully and maintain accurate
                school enrolment records. Previous enrolments are retained
                for historical reference when pupils move between classes
                and academic sessions.
            </p>

        </section>
         <!-- Navigation -->

        <nav class="navigation" aria-label="Pupil progression navigation">

            <a
                href="{{ route('staff.dashboard') }}"
                class="back-link"
            >
                <span aria-hidden="true">←</span>
                Staff Dashboard
            </a>

            <a
                href="{{ route('pupil-progression.audits') }}"
                class="audit-link"
            >
                View Progression Audit History
                <span aria-hidden="true">›</span>
            </a>

        </nav>


        <!-- Process Pupil Movement -->

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
                        <path d="M16 3h5v5"/>
                        <path d="M21 3l-7 7"/>
                        <path d="M8 21H3v-5"/>
                        <path d="M3 21l7-7"/>
                        <path d="M14 14l7 7"/>
                        <path d="M21 16v5h-5"/>
                    </svg>

                </div>

                <div>
                    <h2>Process Pupil Movement</h2>
                    <p>Manage an individual pupil's academic progression</p>
                </div>

            </div>

            <p class="form-intro">
                Select the pupil, their current enrolment, the movement
                action and the destination. Required fields are marked
                with an asterisk (*).
            </p>

            <form
                method="POST"
                action="{{ route('pupil-progression.store') }}"
            >

                @csrf

                <div class="form-grid">

                    <!-- Pupil -->

                    <div class="form-field">

                        <label for="student_id">
                            Pupil *
                        </label>

                        <select
                            id="student_id"
                            name="student_id"
                            required
                        >

                            <option value="">
                                Select pupil
                            </option>

                            @foreach ($students as $student)

                                <option
                                    value="{{ $student->id }}"
                                    @selected((string) old('student_id') === (string) $student->id)
                                >

                                    {{ $student->admission_number }}
                                    —
                                    {{ $student->last_name }},
                                    {{ $student->first_name }}
                                    {{ $student->middle_name }}

                                </option>

                            @endforeach

                        </select>

                        <p class="field-help">
                            Choose the pupil whose enrolment you want to manage.
                        </p>

                    </div>

                    <!-- Current Enrolment -->

                    <div class="form-field">

                        <label for="source_enrollment_id">
                            Current Enrolment *
                        </label>

                        <select
                            id="source_enrollment_id"
                            name="source_enrollment_id"
                            required
                        >

                            <option value="">
                                Select the pupil first
                            </option>

                        </select>

                        <p class="field-help">
                            Only enrolments belonging to the selected pupil
                            will be available.
                        </p>

                    </div>

                    <!-- Movement Action -->

                    <div class="form-field action-field">

                        <label for="action">
                            Movement Action *
                        </label>

                        <select
                            id="action"
                            name="action"
                            required
                        >

                            <option value="">
                                Select action
                            </option>

                            <option
                                value="promote"
                                @selected(old('action') === 'promote')
                            >
                                Promote
                            </option>

                            <option
                                value="repeat"
                                @selected(old('action') === 'repeat')
                            >
                                Repeat Class
                            </option>

                            <option
                                value="demote"
                                @selected(old('action') === 'demote')
                            >
                                Demote
                            </option>

                            <option
                                value="transfer"
                                @selected(old('action') === 'transfer')
                            >
                                Transfer
                            </option>

                        </select>

                    </div>

                    <!-- Destination Session -->

                    <div class="form-field">

                        <label for="destination_session_id">
                            Destination Academic Session *
                        </label>

                        <select
                            id="destination_session_id"
                            name="destination_session_id"
                            required
                        >

                            <option value="">
                                Select session
                            </option>

                            @foreach ($sessions as $session)

                                <option
                                    value="{{ $session->id }}"
                                    @selected((string) old('destination_session_id') === (string) $session->id)
                                >

                                    {{ $session->name }}

                                    {{ $session->is_current ? '(Current)' : '' }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Destination Section -->

                    <div class="form-field">

                        <label for="destination_section_id">
                            Destination Class and Section *
                        </label>

                        <select
                            id="destination_section_id"
                            name="destination_section_id"
                            required
                        >

                            <option value="">
                                Select destination
                            </option>

                            @foreach ($classLevels as $level)

                                <optgroup label="{{ $level->name }}">

                                    @foreach ($level->sections as $section)

                                        <option
                                            value="{{ $section->id }}"
                                            data-class-level-id="{{ $level->id }}"
                                            data-sort-order="{{ $level->sort_order }}"
                                            @selected((string) old('destination_section_id') === (string) $section->id)
                                        >

                                            {{ $level->name }}
                                            —
                                            {{ $section->name }}

                                        </option>

                                    @endforeach

                                </optgroup>

                            @endforeach

                        </select>

                    </div>

                    <!-- Administrative Note -->

                    <div class="form-field full-width">

                        <label for="note">
                            Reason / Administrative Note
                        </label>

                        <textarea
                            id="note"
                            name="note"
                            rows="3"
                            maxlength="1000"
                            placeholder="Optional note for school records"
                        >{{ old('note') }}</textarea>

                        <p class="field-help">
                            Add an optional note for the school's administrative records.
                        </p>

                    </div>

                </div>

                <!-- Movement Rules -->

                <div class="rules-box">

                    <h3>Movement Guidelines</h3>

                    <ul>

                        <li>
                            Promotion requires a higher class level.
                        </li>

                        <li>
                            Repetition requires the same class level.
                        </li>

                        <li>
                            Demotion requires a lower class level.
                        </li>

                        <li>
                            A transfer must remain in the same academic session.
                        </li>

                    </ul>

                </div>

                <!-- Process Button -->

                <button
                    type="submit"
                    class="button button-primary process-button"
                    onclick="return confirm('Please confirm that the selected pupil and destination are correct.');"
                >

                    Process Pupil Movement

                    <span aria-hidden="true">›</span>

                </button>

            </form>

        </section>

        <!-- Pupil Enrolment History -->

        <section class="panel">

            <div class="history-heading">

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
                        </svg>

                    </div>

                    <div>
                        <h2>Pupil Enrolment History</h2>
                        <p>Registered pupils and their historical enrolments</p>
                    </div>

                </div>

                <span class="history-count">
                    {{ $students->total() }}
                </span>

            </div>

            @if ($students->isEmpty())

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
                            <path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="10" cy="7" r="4"/>
                            <path d="M20 8v6"/>
                            <path d="M23 11h-6"/>
                        </svg>

                    </div>

                    <h3>No Pupils Found</h3>

                    <p>
                        No registered pupils were found.
                        Register pupils to begin managing their
                        academic progression and enrolment history.
                    </p>

                </div>

            @else

                <div class="table-wrap">

                    <table>

                        <thead>

                            <tr>
                                <th>Admission Number</th>
                                <th>Pupil</th>
                                <th>Enrolment History</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($students as $student)

                                <tr>

                                    <!-- Admission Number -->

                                    <td>

                                        <span class="admission-number">

                                            {{ $student->admission_number }}

                                        </span>

                                    </td>

                                    <!-- Pupil Name -->

                                    <td>

                                        <span class="pupil-name">

                                            {{ $student->last_name }},
                                            {{ $student->first_name }}
                                            {{ $student->middle_name }}

                                        </span>

                                    </td>

                                    <!-- Enrolment History -->

                                    <td>

                                        @forelse ($student->enrollments as $enrolment)

                                            <div class="history-item">

                                                <span class="history-class">

                                                    {{ $enrolment->section->classLevel->name ?? 'Unknown class' }}

                                                    —

                                                    {{ $enrolment->section->name ?? 'Unknown section' }}

                                                </span>

                                                <span class="history-session">

                                                    {{ $enrolment->academicSession->name ?? 'Unknown session' }}

                                                </span>

                                                <div class="history-status">

                                                    <span class="status-label">

                                                        Enrolment:
                                                        {{ $enrolment->enrollment_status }}

                                                    </span>

                                                    <span class="status-label">

                                                        Progression:
                                                        {{ $enrolment->promotion_status }}

                                                    </span>

                                                </div>

                                            </div>

                                        @empty

                                            <span class="history-session">
                                                No enrolment recorded.
                                            </span>

                                        @endforelse

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <!-- Pagination -->

                <div class="pagination-area">

                    {{ $students->links() }}

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

    <!-- Existing Pupil Enrolment Selection Logic -->

    <script>
        const students = {!! Illuminate\Support\Js::from($studentsData) !!};

        const studentSelect = document.getElementById('student_id');

        const enrollmentSelect = document.getElementById('source_enrollment_id');

        const actionSelect = document.getElementById('action');

        const sessionSelect = document.getElementById('destination_session_id');

        const oldEnrollmentId = {!! Illuminate\Support\Js::from((string) old('source_enrollment_id', '')) !!};

        function updateEnrollments() {

            const student = students.find(
                item => String(item.id) === studentSelect.value
            );

            enrollmentSelect.innerHTML =
                '<option value="">Select enrolment</option>';

            if (!student) {
                return;
            }

            student.enrollments.forEach(enrolment => {

                const option = document.createElement('option');

                option.value = enrolment.id;

                option.textContent =
                    `${enrolment.class_name} — ${enrolment.section_name} ` +
                    `(${enrolment.session_name}) [${enrolment.status}]`;

                if (enrolment.status !== 'enrolled') {
                    option.disabled = true;
                }

                if (String(enrolment.id) === oldEnrollmentId) {
                    option.selected = true;
                }

                enrollmentSelect.appendChild(option);

            });

            updateSessionForAction();

        }

        function updateSessionForAction() {

            const student = students.find(
                item => String(item.id) === studentSelect.value
            );

            const enrolment = student?.enrollments.find(
                item => String(item.id) === enrollmentSelect.value
            );

            if (actionSelect.value === 'transfer' && enrolment) {

                sessionSelect.value = String(enrolment.session_id);

            }

        }

        studentSelect.addEventListener('change', updateEnrollments);

        enrollmentSelect.addEventListener('change', updateSessionForAction);

        actionSelect.addEventListener('change', updateSessionForAction);

        updateEnrollments();
    </script>

</body>
</html>