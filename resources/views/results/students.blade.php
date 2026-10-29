<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Class Pupil List | FNPS Gusau</title>

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
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            max-width: 1250px;
            margin: 0 auto;
            padding: 25px 18px;
            color: var(--text);
            background: var(--background);
        }

        .school-header {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 25px;
            margin-bottom: 22px;
            box-shadow: 0 4px 15px rgba(23, 74, 126, 0.06);
        }

        .school-branding {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
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
            color: var(--primary);
            font-size: 26px;
            margin: 0 0 8px;
            line-height: 1.3;
        }

        .school-title p {
            color: var(--muted);
            margin: 0;
            font-size: 14px;
        }

        .page-heading {
            text-align: center;
            background: var(--primary-light);
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 20px;
        }

        .page-heading h2 {
            color: var(--primary);
            margin: 0 0 6px;
            font-size: 22px;
        }

        .page-heading p {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
        }

        .class-details {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .detail-item {
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 13px 15px;
        }

        .detail-label {
            display: block;
            color: var(--muted);
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 6px;
        }

        .detail-value {
            color: var(--primary);
            font-size: 15px;
            font-weight: bold;
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
            gap: 6px;
            padding: 10px 16px;
            border-radius: 7px;
            background: var(--primary);
            color: var(--white);
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
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

        .panel {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 4px 15px rgba(23, 74, 126, 0.05);
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

        .pupil-count {
            display: inline-block;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 20px;
            padding: 7px 13px;
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
            min-width: 750px;
            border-collapse: collapse;
            background: var(--white);
        }

        th,
        td {
            padding: 14px 15px;
            border-bottom: 1px solid var(--border);
            text-align: left;
            font-size: 14px;
        }

        th {
            background: var(--primary);
            color: var(--white);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            white-space: nowrap;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #f1f6fc;
        }

        .serial-number {
            color: var(--muted);
            font-weight: bold;
            width: 55px;
        }

        .admission-number {
            color: var(--primary);
            font-weight: bold;
            white-space: nowrap;
        }

        .pupil-name {
            font-weight: bold;
        }

        .gender {
            color: var(--muted);
        }

        .view-button {
            display: inline-block;
            background: var(--primary);
            color: var(--white);
            text-decoration: none;
            padding: 8px 13px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: bold;
            white-space: nowrap;
        }

        .view-button:hover {
            background: var(--primary-dark);
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
            margin: 0 0 10px;
            font-size: 18px;
        }

        .empty-state p {
            color: var(--muted);
            margin: 0;
            font-size: 14px;
            line-height: 1.6;
        }

        .footer {
            text-align: center;
            color: var(--muted);
            font-size: 12px;
            margin-top: 25px;
            padding: 15px;
        }

        @media (max-width: 700px) {
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

            .class-details {
                grid-template-columns: 1fr;
            }

            .panel-header h2 {
                font-size: 18px;
            }

            .navigation .button {
                flex: 1;
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
            .view-button {
                display: none;
            }

            tbody tr:hover {
                background: transparent;
            }
        }
    </style>
</head>

<body>

    <div class="school-header">

        <div class="school-branding">

            <img
                src="{{ asset('images/school-logo.jpeg') }}"
                alt="School Logo"
                class="school-logo"
            >

            <div class="school-title">
                <h1>Fatima Nursery and Primary School</h1>
                <p>Gusau, Zamfara State</p>
            </div>

            <img
                src="{{ asset('images/second-school-logo.jpeg') }}"
                alt="School Logo"
                class="school-logo"
            >

        </div>

        <div class="page-heading">
            <h2>Class Pupil List</h2>
            <p>Enrolled pupils for the selected academic session and term</p>
        </div>

        <div class="class-details">

            <div class="detail-item">
                <span class="detail-label">Class and Section</span>
                <span class="detail-value">
                    {{ $section->classLevel->name }} — {{ $section->name }}
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Academic Session</span>
                <span class="detail-value">
                    {{ $session->name }}
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Academic Term</span>
                <span class="detail-value">
                    {{ $term }}
                </span>
            </div>

        </div>

        <div class="navigation">

            <a
                class="button button-secondary"
                href="{{ route('results.classes', [
                    'session_id' => $session->id,
                    'term' => $term,
                ]) }}"
            >
                &larr; Back to Classes
            </a>

            <a
                class="button"
                href="{{ route('staff.dashboard') }}"
            >
                Staff Dashboard
            </a>

        </div>

    </div>

    <div class="panel">

        <div class="panel-header">

            <h2>Enrolled Pupils</h2>

            <span class="pupil-count">
                {{ $enrollments->count() }}
                {{ $enrollments->count() === 1 ? 'Pupil' : 'Pupils' }}
            </span>

        </div>

        @if ($enrollments->isEmpty())

            <div class="empty-state">

                <h3>No Pupils Enrolled</h3>

                <p>
                    No pupils are enrolled in this section for this academic session.
                </p>

            </div>

        @else

            <div class="table-wrap">

                <table>

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Admission Number</th>
                            <th>Pupil's Full Name</th>
                            <th>Gender</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($enrollments as $enrollment)

                            <tr>

                                <td class="serial-number">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="admission-number">
                                    {{ $enrollment->student->admission_number }}
                                </td>

                                <td class="pupil-name">
                                    {{ $enrollment->student->last_name }},
                                    {{ $enrollment->student->first_name }}
                                    {{ $enrollment->student->middle_name }}
                                </td>

                                <td class="gender">
                                    {{ $enrollment->student->gender
                                        ? ucfirst($enrollment->student->gender)
                                        : '—' }}
                                </td>

                                <td>

                                    <a
                                        class="view-button"
                                        href="{{ route('results.student', [
                                            'student' => $enrollment->student->id,
                                            'session_id' => $session->id,
                                            'term' => $term,
                                        ]) }}"
                                    >
                                        View Results
                                    </a>

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