<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Score Entry | FNPS Gusau</title>

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
            max-width: 1250px;
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

        /* Main Container */

        .page-container {
            max-width: 1250px;
            margin: 0 auto;
            padding: 35px 22px 50px;
        }

        .page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 28px;
        }

        .page-heading h2 {
            margin: 0;
            color: #173f7a;
            font-size: 30px;
            font-weight: 800;
        }

        .page-heading p {
            margin: 9px 0 0;
            color: #718096;
            font-size: 14px;
            line-height: 1.6;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 12px 18px;
            background: #ffffff;
            border: 1px solid #d8e5f5;
            border-radius: 10px;
            color: #24518e;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: background 0.2s, transform 0.2s;
        }

        .back-button:hover {
            background: #edf4ff;
            transform: translateY(-1px);
        }

        /* Messages */

        .message {
            padding: 15px 18px;
            border-radius: 11px;
            margin-bottom: 22px;
            font-size: 14px;
            line-height: 1.6;
        }

        .success {
            color: #166534;
            background: #ecfdf3;
            border: 1px solid #bbf7d0;
        }

        .error {
            color: #b42335;
            background: #fff1f2;
            border: 1px solid #fecdd3;
        }

        .error ul {
            margin: 10px 0 0;
            padding-left: 22px;
        }

        .error li {
            margin-bottom: 5px;
        }

        /* General Panels */

        .panel {
            background: #ffffff;
            border: 1px solid #e2eaf5;
            border-radius: 18px;
            padding: 27px;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(30, 64, 125, 0.07);
        }

        .panel-heading {
            display: flex;
            align-items: center;
            gap: 14px;
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

        /* Forms */

        .selection-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .form-group {
            min-width: 0;
            margin-bottom: 21px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        label {
            display: block;
            margin-bottom: 9px;
            color: #243b60;
            font-size: 14px;
            font-weight: 700;
        }

        select,
        input {
            width: 100%;
            min-width: 0;
            padding: 13px 14px;
            border: 1px solid #d6e0ef;
            border-radius: 10px;
            background: #f9fbff;
            color: #17345f;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        select:focus,
        input:focus {
            border-color: #2563eb;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        select {
            cursor: pointer;
        }

        /* Buttons */

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 13px 22px;
            border: none;
            border-radius: 10px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .primary-button {
            color: #ffffff;
            background: linear-gradient(135deg, #1d4ed8, #123f91);
            box-shadow: 0 6px 16px rgba(29, 78, 216, 0.20);
        }

        .primary-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 9px 22px rgba(29, 78, 216, 0.28);
        }

        .button:focus-visible {
            outline: 3px solid #93c5fd;
            outline-offset: 3px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 24px;
        }

        /* Selected Class Information */

        .class-banner {
            background: linear-gradient(135deg, #1d4ed8, #123f91);
            color: #ffffff;
            border-radius: 16px;
            padding: 23px 26px;
            margin-bottom: 25px;
            box-shadow: 0 10px 25px rgba(29, 78, 216, 0.16);
        }

        .class-banner h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 800;
        }

        .class-banner p {
            margin: 10px 0 0;
            color: #dbeafe;
            font-size: 14px;
            line-height: 1.6;
        }

        .class-details {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 17px;
        }

        .class-detail {
            padding: 9px 13px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.13);
            border: 1px solid rgba(255, 255, 255, 0.18);
            color: #ffffff;
            font-size: 13px;
        }

        .class-detail strong {
            color: #ffffff;
        }

        /* Subject Selection */

        .subject-form {
            display: flex;
            align-items: flex-end;
            gap: 18px;
            flex-wrap: wrap;
        }

        .subject-form .form-group {
            flex: 1;
            min-width: 220px;
        }

        /* Score Instructions */

        .score-instructions {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 13px;
            margin-bottom: 24px;
        }

        .score-limit {
            padding: 15px;
            border-radius: 11px;
            background: #f5f8ff;
            border: 1px solid #e1eafa;
            text-align: center;
        }

        .score-limit span {
            display: block;
            color: #718096;
            font-size: 12px;
            margin-bottom: 7px;
        }

        .score-limit strong {
            color: #1d4ed8;
            font-size: 20px;
            font-weight: 800;
        }

        /* Table */

        .table-wrap {
            width: 100%;
            overflow-x: auto;
            border: 1px solid #e2eaf5;
            border-radius: 12px;
            margin-top: 20px;
        }

        table {
            width: 100%;
            min-width: 850px;
            border-collapse: separate;
            border-spacing: 0;
            background: #ffffff;
        }

        thead th {
            padding: 16px 13px;
            background: #eaf2ff;
            color: #1e4580;
            font-size: 13px;
            font-weight: 800;
            text-align: left;
            white-space: nowrap;
            border-bottom: 1px solid #d5e3f6;
        }

        tbody td {
            padding: 13px;
            color: #344b6d;
            font-size: 13px;
            border-bottom: 1px solid #edf2f8;
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #f8faff;
        }

        .pupil-name {
            min-width: 200px;
            color: #244777;
            font-weight: 700;
            line-height: 1.6;
        }

        .admission-number {
            color: #718096;
            white-space: nowrap;
        }

        .score-input {
            width: 85px;
            min-width: 85px;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            font-weight: 700;
            border-radius: 8px;
            background: #ffffff;
        }

        .total-cell {
            color: #1d4ed8;
            font-weight: 800;
            white-space: nowrap;
        }

        .total-empty {
            color: #9aa9bd;
        }

        /* Notes */

        .help-note {
            padding: 15px 17px;
            margin-top: 20px;
            border-radius: 10px;
            background: #f0f6ff;
            border: 1px solid #dbeafe;
            color: #466487;
            font-size: 13px;
            line-height: 1.7;
        }

        .help-note strong {
            color: #1e4580;
        }

        /* Empty State */

        .empty-state {
            padding: 25px 18px;
            text-align: center;
            background: #f8faff;
            border: 1px dashed #cbd9eb;
            border-radius: 13px;
        }

        .empty-state h3 {
            margin: 0 0 9px;
            color: #244777;
            font-size: 16px;
        }

        .empty-state p {
            margin: 0;
            color: #718096;
            font-size: 13px;
            line-height: 1.7;
        }

        /* Footer */

        .footer {
            padding: 20px 15px;
            text-align: center;
            color: #718096;
            font-size: 12px;
        }

        .footer strong {
            color: #31558a;
        }

        /* Responsive */

        @media (max-width: 900px) {
            .selection-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .selection-grid .form-group:last-child {
                grid-column: 1 / -1;
            }

            .page-container {
                padding: 28px 18px 40px;
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

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .page-heading h2 {
                font-size: 26px;
            }

            .back-button {
                width: 100%;
            }

            .panel {
                padding: 20px;
                border-radius: 15px;
            }

            .panel-heading h2 {
                font-size: 18px;
            }

            .selection-grid {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .selection-grid .form-group:last-child {
                grid-column: auto;
            }

            .form-actions .button {
                width: 100%;
            }

            .class-banner {
                padding: 20px;
            }

            .class-banner h2 {
                font-size: 21px;
            }

            .subject-form {
                align-items: stretch;
                flex-direction: column;
            }

            .subject-form .form-group {
                min-width: 0;
                width: 100%;
            }

            .subject-form .button {
                width: 100%;
            }

            .score-instructions {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .score-limit {
                display: flex;
                align-items: center;
                justify-content: space-between;
                text-align: left;
                padding: 13px 16px;
            }

            .score-limit span {
                margin: 0;
            }

            .score-limit strong {
                font-size: 18px;
            }
        }

        @media (max-width: 360px) {
            .school-logo {
                width: 48px;
                height: 48px;
            }

            .school-title h1 {
                font-size: 16px;
            }

            .page-container {
                padding-left: 12px;
                padding-right: 12px;
            }

            .panel {
                padding: 16px;
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
                <p>Gusau, Zamfara State · Staff Portal</p>
            </div>

            <img
                src="{{ asset('images/second-school-logo.jpeg') }}"
                alt="FNPS Gusau Second School Logo"
                class="school-logo"
            >

        </div>
    </header>

    <!-- Main Content -->

    <main class="page-container">

        <!-- Page Heading -->

        <div class="page-heading">

            <div>
                <h2>Score Entry</h2>

                <p>
                    Select your class, academic session, term and subject
                    to enter and manage pupil scores.
                </p>
            </div>

            <a
                href="{{ route('staff.dashboard') }}"
                class="back-button"
            >
                <span aria-hidden="true">←</span>
                Back to Dashboard
            </a>

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

                <strong>Please correct these errors:</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif

        <!-- Class, Session and Term Selection -->

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
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                        <path d="M8 7h8"/>
                        <path d="M8 11h8"/>
                    </svg>
                </div>

                <div>
                    <h2>Select Class, Session and Term</h2>
                    <p>Choose the academic details for score entry</p>
                </div>

            </div>

            <form method="GET" action="{{ route('results.entry') }}">

                <div class="selection-grid">

                    <div class="form-group">

                        <label for="term">Academic Term</label>

                        <select id="term" name="term" required>

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

                    <div class="form-group">

                        <label for="session_id">Academic Session</label>

                        <select
                            id="session_id"
                            name="session_id"
                            required
                        >

                            <option value="">Select session</option>

                            @foreach ($sessions as $session)

                                <option
                                    value="{{ $session->id }}"
                                    @selected(
                                        (string) request(
                                            'session_id',
                                            $currentSession?->id
                                        ) === (string) $session->id
                                    )
                                >
                                    {{ $session->name }}

                                    @if ($session->is_current)
                                        — Current
                                    @endif
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="form-group">

                        <label for="section_id">Class / Section</label>

                        <select
                            id="section_id"
                            name="section_id"
                            required
                        >

                            <option value="">Select section</option>

                            @foreach ($sections as $section)

                                <option
                                    value="{{ $section->id }}"
                                    @selected(
                                        (string) request('section_id')
                                        === (string) $section->id
                                    )
                                >
                                    {{ $section->classLevel->name }}
                                    — {{ $section->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="form-actions">

                    <button
                        type="submit"
                        class="button primary-button"
                    >
                        Load Class
                        <span aria-hidden="true">→</span>
                    </button>

                </div>

            </form>

        </section>

        <!-- Selected Class and Subject -->

        @if ($selectedSection && $selectedSession)

            <section class="class-banner">

                <h2>
                    {{ $selectedSection->classLevel->name }}
                    — {{ $selectedSection->name }}
                </h2>

                <p>
                    Selected class and academic details
                </p>

                <div class="class-details">

                    <div class="class-detail">
                        Academic Session:
                        <strong>{{ $selectedSession->name }}</strong>
                    </div>

                    <div class="class-detail">
                        Term:
                        <strong>{{ $selectedTerm }}</strong>
                    </div>

                </div>

            </section>

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
                            <path d="M4 5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2Z"/>
                            <path d="M8 7h8"/>
                            <path d="M8 11h8"/>
                            <path d="M8 15h5"/>
                        </svg>
                    </div>

                    <div>
                        <h2>Select Subject</h2>
                        <p>Choose the subject whose scores you want to manage</p>
                    </div>

                </div>

                <form
                    method="GET"
                    action="{{ route('results.entry') }}"
                    class="subject-form"
                >

                    <input
                        type="hidden"
                        name="section_id"
                        value="{{ $selectedSection->id }}"
                    >

                    <input
                        type="hidden"
                        name="session_id"
                        value="{{ $selectedSession->id }}"
                    >

                    <input
                        type="hidden"
                        name="term"
                        value="{{ $selectedTerm }}"
                    >

                    <div class="form-group">

                        <label for="subject_id">Subject</label>

                        <select
                            id="subject_id"
                            name="subject_id"
                            required
                        >

                            <option value="">Select subject</option>

                            @foreach ($subjects as $subject)

                                <option
                                    value="{{ $subject->id }}"
                                    @selected(
                                        (string) $selectedSubjectId
                                        === (string) $subject->id
                                    )
                                >
                                    {{ $subject->name }}
                                    ({{ $subject->code }})
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <button
                        type="submit"
                        class="button primary-button"
                    >
                        Load Pupils
                        <span aria-hidden="true">→</span>
                    </button>

                </form>

                @if ($subjects->isEmpty())

                    <div class="help-note">
                        <strong>No subjects available.</strong>
                        No active subjects have been assigned to this
                        class level.
                    </div>

                @endif

            </section>

        @endif

        <!-- Score Entry -->

        @if (
            $selectedSection &&
            $selectedSession &&
            $selectedSubjectId &&
            $subjects->contains('id', $selectedSubjectId)
        )

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
                            <path d="M8 2h8l4 4v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2Z"/>
                            <path d="M16 2v5h4"/>
                            <path d="M8 13h8"/>
                            <path d="M8 17h8"/>
                            <path d="M8 9h2"/>
                        </svg>
                    </div>

                    <div>
                        <h2>Enter Scores</h2>
                        <p>
                            {{ $selectedTerm }} ·
                            {{ $selectedSection->classLevel->name }}
                            — {{ $selectedSection->name }}
                        </p>
                    </div>

                </div>

                <!-- Score Limits -->

                <div class="score-instructions">

                    <div class="score-limit">
                        <span>First Assessment</span>
                        <strong> / 20</strong>
                    </div>

                    <div class="score-limit">
                        <span>Second Assessment</span>
                        <strong> / 20</strong>
                    </div>

                    <div class="score-limit">
                        <span>Examination</span>
                        <strong> / 60</strong>
                    </div>

                </div>

                @if ($enrollments->isEmpty())

                    <div class="empty-state">

                        <h3>No Pupils Found</h3>

                        <p>
                            No currently enrolled pupils were found
                            for this section and academic session.
                        </p>

                    </div>

                @else

                    <form
                        method="POST"
                        action="{{ route('results.store') }}"
                    >

                        @csrf

                        <input
                            type="hidden"
                            name="section_id"
                            value="{{ $selectedSection->id }}"
                        >

                        <input
                            type="hidden"
                            name="session_id"
                            value="{{ $selectedSession->id }}"
                        >

                        <input
                            type="hidden"
                            name="subject_id"
                            value="{{ $selectedSubjectId }}"
                        >

                        <input
                            type="hidden"
                            name="term"
                            value="{{ $selectedTerm }}"
                        >

                        <div class="table-wrap">

                            <table>

                                <thead>
                                    <tr>
                                        <th>Pupil</th>
                                        <th>Admission No.</th>
                                        <th>First /20</th>
                                        <th>Second /20</th>
                                        <th>Exam /60</th>
                                        <th>Total /100</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($enrollments as $enrollment)

                                        @php
                                            $result = $enrollment->result ?? null;

                                            $first = $result?->first_assessment;
                                            $second = $result?->second_assessment;
                                            $exam = $result?->exam;

                                            $total = $first !== null
                                                && $second !== null
                                                && $exam !== null
                                                    ? (float) $first
                                                        + (float) $second
                                                        + (float) $exam
                                                    : null;
                                        @endphp

                                        <tr>

                                            <td class="pupil-name">
                                                {{ $enrollment->student->last_name }},
                                                {{ $enrollment->student->first_name }}
                                                {{ $enrollment->student->middle_name }}
                                            </td>

                                            <td class="admission-number">
                                                {{ $enrollment->student->admission_number }}
                                            </td>

                                            <td>

                                                <input
                                                    class="score-input"
                                                    type="number"
                                                    name="scores[{{ $enrollment->id }}][first_assessment]"
                                                    min="0"
                                                    max="20"
                                                    step="0.01"
                                                    aria-label="First assessment score for {{ $enrollment->student->last_name }}, {{ $enrollment->student->first_name }}"
                                                    value="{{ old('scores.'.$enrollment->id.'.first_assessment', $first) }}"
                                                >

                                            </td>

                                            <td>

                                                <input
                                                    class="score-input"
                                                    type="number"
                                                    name="scores[{{ $enrollment->id }}][second_assessment]"
                                                    min="0"
                                                    max="20"
                                                    step="0.01"
                                                    aria-label="Second assessment score for {{ $enrollment->student->last_name }}, {{ $enrollment->student->first_name }}"
                                                    value="{{ old('scores.'.$enrollment->id.'.second_assessment', $second) }}"
                                                >

                                            </td>

                                            <td>

                                                <input
                                                    class="score-input"
                                                    type="number"
                                                    name="scores[{{ $enrollment->id }}][exam]"
                                                    min="0"
                                                    max="60"
                                                    step="0.01"
                                                    aria-label="Exam score for {{ $enrollment->student->last_name }}, {{ $enrollment->student->first_name }}"
                                                    value="{{ old('scores.'.$enrollment->id.'.exam', $exam) }}"
                                                >

                                            </td>

                                            <td
                                                class="total-cell {{ $total === null ? 'total-empty' : '' }}"
                                            >

                                                {{ $total !== null
                                                    ? number_format($total, 2)
                                                    : '—' }}

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                        <div class="help-note">
                            <strong>Score entry reminder:</strong>
                            First Assessment is out of 20,
                            Second Assessment is out of 20,
                            and Examination is out of 60.
                            Leave a pupil's row blank if you are not
                            entering scores for that pupil yet.
                        </div>

                        <div class="form-actions">

                            <button
                                type="submit"
                                class="button primary-button"
                            >
                                Save Scores
                                <span aria-hidden="true">→</span>
                            </button>

                        </div>

                    </form>

                @endif

            </section>

        @endif

    </main>

    <!-- Footer -->

    <footer class="footer">
        &copy; {{ date('Y') }}
        <strong>Fatima Nursery and Primary School, Gusau</strong>.
        All rights reserved.
    </footer>

</body>
</html>
