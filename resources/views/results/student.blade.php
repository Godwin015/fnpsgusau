<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pupil Results | FNPS Gusau</title>

    <style>
        :root {
            --primary: #174a7e;
            --primary-dark: #10365d;
            --primary-light: #eaf2fb;
            --background: #f3f6fb;
            --white: #ffffff;
            --text: #1e293b;
            --muted: #64748b;
            --border: #dce5ef;
            --success: #15803d;
            --success-light: #ecfdf3;
            --warning: #b45309;
            --warning-light: #fff7ed;
            --danger: #b91c1c;
            --danger-light: #fef2f2;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            max-width: 1350px;
            margin: 0 auto;
            padding: 25px 18px;
            color: var(--text);
            background: var(--background);
        }

        .school-header,
        .panel {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
            box-shadow: 0 4px 15px rgba(23, 74, 126, 0.05);
        }

        .school-branding {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
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
            color: var(--primary);
            font-size: 26px;
            line-height: 1.3;
            margin: 0 0 8px;
        }

        .school-title p {
            color: var(--muted);
            font-size: 14px;
            margin: 0;
        }

        .page-heading {
            background: var(--primary-light);
            border-radius: 10px;
            text-align: center;
            padding: 17px;
        }

        .page-heading h2 {
            color: var(--primary);
            font-size: 22px;
            margin: 0 0 6px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 14px;
            margin: 0;
        }

        .success-message {
            background: var(--success-light);
            border: 1px solid #bbf7d0;
            border-left: 5px solid var(--success);
            color: #166534;
            border-radius: 8px;
            padding: 14px 16px;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.5;
        }

        .student-card {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }

        .student-detail {
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 14px 15px;
        }

        .detail-label {
            display: block;
            color: var(--muted);
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 7px;
        }

        .detail-value {
            display: block;
            color: var(--primary);
            font-size: 15px;
            font-weight: bold;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .navigation {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 16px;
            border: none;
            border-radius: 7px;
            background: var(--primary);
            color: var(--white);
            text-decoration: none;
            font-family: inherit;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .button:hover {
            background: var(--primary-dark);
        }

        .button-secondary {
            background: #e8eef6;
            color: var(--primary);
            border: 1px solid var(--border);
        }

        .button-secondary:hover {
            background: #d8e5f4;
        }

        .button-success {
            background: var(--success);
        }

        .button-success:hover {
            background: #166534;
        }

        .button-danger {
            background: var(--danger);
        }

        .button-danger:hover {
            background: #991b1b;
        }

        .button:disabled {
            background: #cbd5e1;
            color: #64748b;
            cursor: not-allowed;
        }

        .term-form {
            display: flex;
            flex-wrap: wrap;
            align-items: end;
            gap: 12px;
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 17px;
        }

        .term-field {
            flex: 1;
            min-width: 180px;
        }

        .term-field label {
            display: block;
            color: var(--primary);
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .term-field select {
            width: 100%;
            min-height: 42px;
            padding: 9px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            background: var(--white);
            color: var(--text);
            font-family: inherit;
            font-size: 14px;
        }

        .term-field select:focus {
            outline: 2px solid #93c5fd;
            outline-offset: 1px;
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
        }

        .panel-header h2 {
            color: var(--primary);
            font-size: 20px;
            margin: 0;
        }

        .result-count {
            display: inline-block;
            padding: 7px 13px;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .table-wrap {
            overflow-x: auto;
            border: 1px solid var(--border);
            border-radius: 10px;
        }

        table {
            width: 100%;
            min-width: 1050px;
            border-collapse: collapse;
            background: var(--white);
        }

        th,
        td {
            padding: 13px 12px;
            border-bottom: 1px solid var(--border);
            text-align: left;
            vertical-align: middle;
            font-size: 13px;
        }

        th {
            background: var(--primary);
            color: var(--white);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            white-space: nowrap;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #f1f6fc;
        }

        .subject-name {
            color: var(--primary);
            font-weight: bold;
            min-width: 130px;
        }

        .score {
            text-align: center;
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }

        .total-score {
            color: var(--primary);
            font-weight: bold;
            text-align: center;
            white-space: nowrap;
        }

        .incomplete {
            color: var(--warning);
            font-weight: bold;
            white-space: nowrap;
        }

        .status-text {
            display: inline-block;
            padding: 5px 9px;
            background: #f1f5f9;
            color: #475569;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .publication-published {
            display: inline-block;
            padding: 5px 9px;
            background: var(--success-light);
            color: var(--success);
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .publication-unpublished {
            display: inline-block;
            padding: 5px 9px;
            background: var(--warning-light);
            color: var(--warning);
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .publication-actions {
            min-width: 180px;
        }

        .publication-actions form {
            margin-top: 10px;
        }

        .publication-actions .button {
            padding: 8px 12px;
            font-size: 12px;
        }

        .empty-state {
            text-align: center;
            padding: 45px 20px;
            background: #f8fafc;
            border: 1px dashed var(--border);
            border-radius: 10px;
        }

        .empty-state h3 {
            color: var(--primary);
            font-size: 18px;
            margin: 0 0 10px;
        }

        .empty-state p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        .footer {
            text-align: center;
            color: var(--muted);
            font-size: 12px;
            margin-top: 25px;
            padding: 15px;
        }

        @media (max-width: 750px) {
            body {
                padding: 15px 10px;
            }

            .school-header,
            .panel {
                padding: 16px;
            }

            .school-branding {
                gap: 10px;
            }

            .school-logo {
                width: 55px;
                height: 55px;
            }

            .school-title h1 {
                font-size: 18px;
            }

            .school-title p {
                font-size: 12px;
            }

            .student-card {
                grid-template-columns: 1fr;
            }

            .navigation .button {
                flex: 1;
            }

            .term-form {
                align-items: stretch;
            }

            .term-field {
                min-width: 100%;
            }

            .term-form .button {
                width: 100%;
            }

            .panel-header h2 {
                font-size: 18px;
            }
        }

        @media print {
            body {
                background: #fff;
                max-width: none;
                padding: 0;
            }

            .school-header,
            .panel {
                box-shadow: none;
            }

            .navigation,
            .term-form,
            .publication-actions form {
                display: none;
            }

            tbody tr:hover {
                background: transparent;
            }

            table {
                min-width: 0;
            }

            th,
            td {
                padding: 8px 6px;
                font-size: 10px;
            }
        }
    </style>
</head>

<body>

    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <div class="school-header">

        <div class="school-branding">

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
                alt="FNPS Gusau School Logo"
                class="school-logo"
            >

        </div>

        <div class="page-heading">
            <h2>Pupil Results</h2>
            <p>Academic performance and result publication</p>
        </div>

    </div>

    <div class="panel">

        <div class="panel-header">
            <h2>Pupil Information</h2>
        </div>

        <div class="student-card">

            <div class="student-detail">
                <span class="detail-label">Pupil's Full Name</span>
                <span class="detail-value">
                    {{ $student->first_name }}
                    {{ $student->middle_name }}
                    {{ $student->last_name }}
                </span>
            </div>

            <div class="student-detail">
                <span class="detail-label">Admission Number</span>
                <span class="detail-value">
                    {{ $student->admission_number }}
                </span>
            </div>

            <div class="student-detail">
                <span class="detail-label">Class and Section</span>
                <span class="detail-value">
                    {{ $enrollment->section->classLevel->name }}
                    — {{ $enrollment->section->name }}
                </span>
            </div>

            <div class="student-detail">
                <span class="detail-label">Academic Session</span>
                <span class="detail-value">
                    {{ $session->name }}
                </span>
            </div>

            <div class="student-detail">
                <span class="detail-label">Academic Term</span>
                <span class="detail-value">
                    {{ $term }}
                </span>
            </div>

        </div>

        <form
            method="GET"
            action="{{ route('results.student', [
                'student' => $student->id,
            ]) }}"
            class="term-form"
        >

            <input
                type="hidden"
                name="session_id"
                value="{{ $session->id }}"
            >

            <div class="term-field">

                <label for="term">
                    View Another Term
                </label>

                <select name="term" id="term" required>

                    @foreach ($terms as $availableTerm)

                        <option
                            value="{{ $availableTerm }}"
                            @selected($term === $availableTerm)
                        >
                            {{ $availableTerm }}
                        </option>

                    @endforeach

                </select>

            </div>

            <button type="submit" class="button">
                View Term
            </button>

        </form>

        <div class="navigation">

            <a
                class="button button-secondary"
                href="{{ route('results.students', [
                    'section' => $enrollment->section_id,
                    'session_id' => $session->id,
                    'term' => $term,
                ]) }}"
            >
                &larr; Back to Pupil List
            </a>

            <a
                class="button"
                href="{{ route('results.student.pdf', [
                    'student' => $student->id,
                    'session_id' => $session->id,
                    'term' => $term,
                ]) }}"
            >
                Download Results as PDF
            </a>

        </div>

    </div>

    <div class="panel">

        <div class="panel-header">

            <h2>Subject Results</h2>

            <span class="result-count">
                {{ $results->count() }}
                {{ $results->count() === 1 ? 'Subject' : 'Subjects' }}
            </span>

        </div>

        @if ($results->isEmpty())

            <div class="empty-state">

                <h3>No Results Available</h3>

                <p>
                    No results have been entered for this pupil in this session.
                </p>

            </div>

        @else

            <div class="table-wrap">

                <table>

                    <thead>

                        <tr>
                            <th>Subject</th>
                            <th>First Assessment /20</th>
                            <th>Second Assessment /20</th>
                            <th>Exam /60</th>
                            <th>Total /100</th>
                            <th>Status</th>
                            <th>Publication</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($results as $result)

                            @php
                                $complete = $result->first_assessment !== null
                                    && $result->second_assessment !== null
                                    && $result->exam !== null;

                                $total = $complete
                                    ? (float) $result->first_assessment
                                        + (float) $result->second_assessment
                                        + (float) $result->exam
                                    : null;
                            @endphp

                            <tr>

                                <td class="subject-name">
                                    {{ $result->subject->name }}
                                </td>

                                <td class="score">
                                    {{ $result->first_assessment ?? '—' }}
                                </td>

                                <td class="score">
                                    {{ $result->second_assessment ?? '—' }}
                                </td>

                                <td class="score">
                                    {{ $result->exam ?? '—' }}
                                </td>

                                <td class="total-score">

                                    @if ($total !== null)
                                        {{ number_format($total, 2) }}
                                    @else
                                        <span class="incomplete">
                                            Incomplete
                                        </span>
                                    @endif

                                </td>

                                <td>
                                    <span class="status-text">
                                        {{ ucfirst($result->status) }}
                                    </span>
                                </td>

                                <td class="publication-actions">

                                    @if ($result->published_at)

                                        <span class="publication-published">
                                            Published
                                        </span>

                                        @if (auth()->user()->role === 'super_admin')

                                            <form
                                                method="POST"
                                                action="{{ route('results.unpublish', $result) }}"
                                                onsubmit="return confirm('Unpublish this result? The pupil will no longer be able to download it.');"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="button button-danger"
                                                >
                                                    Unpublish
                                                </button>

                                            </form>

                                        @endif

                                    @else

                                        <span class="publication-unpublished">
                                            Not Published
                                        </span>

                                        @if (auth()->user()->role === 'super_admin')

                                            <form
                                                method="POST"
                                                action="{{ route('results.publish', $result) }}"
                                                onsubmit="return confirm('Publish this completed result for the pupil?');"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="button button-success"
                                                    @disabled(
                                                        $result->status !== 'submitted'
                                                        || $result->first_assessment === null
                                                        || $result->second_assessment === null
                                                        || $result->exam === null
                                                    )
                                                >
                                                    Publish
                                                </button>

                                            </form>

                                        @endif

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>

    <div class="footer">
        Fatima Nursery and Primary School, Gusau
    </div>

</body>
</html>
