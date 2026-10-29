<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Parent Portal | FNPS Gusau</title>

    <style>
        :root {
            --primary: #1769d2;
            --primary-dark: #104da3;
            --primary-light: #eaf3ff;
            --primary-soft: #f3f8ff;
            --text: #1e293b;
            --muted: #64748b;
            --border: #dce6f2;
            --white: #ffffff;
            --success: #166534;
            --success-bg: #dcfce7;
            --danger: #b91c1c;
            --danger-bg: #fee2e2;
            --shadow: 0 8px 28px rgba(23, 105, 210, 0.08);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 30px 16px;
            color: var(--text);
            background: linear-gradient(
                180deg,
                #eaf3ff 0,
                #f5f9ff 280px,
                #f7f9fc 100%
            );
            line-height: 1.6;
        }

        .page-container {
            max-width: 950px;
            margin: 0 auto;
        }

        /* SCHOOL HEADER */

        .school-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 24px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 28px;
        }

        .school-logo,
        .school-logo-right {
            width: 115px;
            height: 115px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .school-header-center {
            flex: 1;
            min-width: 0;
            text-align: center;
        }

        .school-header-center h1 {
            color: var(--primary-dark);
            font-size: 28px;
            line-height: 1.3;
            margin: 0;
            font-weight: 800;
        }

        .school-header-center p {
            color: var(--muted);
            margin: 8px 0 0;
            font-size: 15px;
        }

        .school-tagline {
            display: inline-block;
            margin-top: 12px;
            padding: 5px 12px;
            border-radius: 30px;
            background: var(--primary-light);
            color: var(--primary-dark);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        /* WELCOME */

        .welcome-section {
            margin-bottom: 25px;
        }

        .welcome-section h2 {
            margin: 0;
            color: var(--primary-dark);
            font-size: 25px;
        }

        .welcome-section p {
            margin: 5px 0 0;
            color: var(--muted);
        }

        /* NOTIFICATIONS */

        .message,
        .error {
            padding: 14px 18px;
            border-radius: 12px;
            margin: 18px 0;
            font-size: 14px;
            font-weight: 600;
        }

        .message {
            color: var(--success);
            background: var(--success-bg);
            border: 1px solid #bbf7d0;
        }

        .error {
            color: var(--danger);
            background: var(--danger-bg);
            border: 1px solid #fecaca;
        }

        /* MAIN PANELS */

        .panel {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 26px;
            margin: 22px 0;
            box-shadow: var(--shadow);
        }

        .panel h2 {
            color: var(--primary-dark);
            font-size: 21px;
            margin: 0 0 20px;
            padding-bottom: 13px;
            border-bottom: 1px solid var(--border);
        }

        .section-description {
            color: var(--muted);
            font-size: 14px;
            margin: -8px 0 20px;
        }

        /* PUPIL INFORMATION */

        .pupil-info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 15px;
        }

        .info-item {
            padding: 16px;
            background: var(--primary-soft);
            border: 1px solid #e0ecff;
            border-radius: 12px;
            min-width: 0;
        }

        .info-label {
            display: block;
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .info-value {
            color: var(--text);
            font-size: 16px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .status-badge {
            display: inline-block;
            background: #dbeafe;
            color: #1d4ed8;
            border-radius: 30px;
            padding: 5px 12px;
            font-size: 12px;
            font-weight: 700;
        }

        /* ENROLMENT HISTORY */

        .enrolment-card {
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 18px;
            background: #ffffff;
            transition: box-shadow 0.2s ease,
                        border-color 0.2s ease;
        }

        .enrolment-card:last-child {
            margin-bottom: 0;
        }

        .enrolment-card:hover {
            border-color: #9cc5ff;
            box-shadow: 0 5px 18px rgba(23, 105, 210, 0.08);
        }

        .enrolment-heading {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 16px;
        }

        .enrolment-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border-radius: 12px;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 20px;
        }

        .enrolment-heading h3 {
            color: var(--text);
            font-size: 17px;
            margin: 0;
        }

        .enrolment-heading p {
            color: var(--muted);
            font-size: 14px;
            margin: 3px 0 0;
        }

        /* RESULT DOWNLOAD FORM */

        .result-form {
            border-top: 1px solid var(--border);
            padding-top: 16px;
            margin-top: 16px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: 700;
            color: var(--text);
        }

        select {
            display: block;
            width: 100%;
            min-height: 48px;
            padding: 11px 14px;
            border: 1px solid #cbd8e8;
            border-radius: 10px;
            background: #ffffff;
            color: var(--text);
            font-family: inherit;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s ease,
                        box-shadow 0.2s ease;
        }

        select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(23, 105, 210, 0.12);
        }

        /* BUTTONS */

        button {
            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            border: none;
            border-radius: 10px;
            padding: 13px 18px;
            min-height: 46px;
            cursor: pointer;
            transition: background 0.2s ease,
                        transform 0.2s ease,
                        box-shadow 0.2s ease;
        }

        .download-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            width: 100%;
            margin-top: 15px;
            color: #ffffff;
            background: var(--primary);
            box-shadow: 0 4px 10px rgba(23, 105, 210, 0.18);
        }

        .download-button:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(23, 105, 210, 0.22);
        }

        .download-button:active {
            transform: translateY(0);
        }

        .logout-section {
            display: flex;
            justify-content: flex-end;
            margin: 25px 0;
        }

        .logout-button {
            color: #ffffff;
            background: #334155;
            min-width: 140px;
        }

        .logout-button:hover {
            background: #1e293b;
        }

        /* RESULTS INFORMATION */

        .results-info {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 18px;
            background: var(--primary-soft);
            border: 1px solid #dbeafe;
            border-radius: 12px;
        }

        .results-info-icon {
            font-size: 24px;
            flex-shrink: 0;
        }

        .results-info p {
            margin: 0;
            color: #334155;
            font-size: 14px;
        }

        /* FOOTER */

        .footer {
            text-align: center;
            padding: 20px 10px;
            color: var(--muted);
            font-size: 12px;
        }

        /* TABLET */

        @media (max-width: 768px) {
            body {
                padding: 20px 12px;
            }

            .school-header {
                gap: 12px;
                padding: 18px 14px;
                border-radius: 16px;
            }

            .school-logo,
            .school-logo-right {
                width: 85px;
                height: 85px;
            }

            .school-header-center h1 {
                font-size: 22px;
            }

            .school-header-center p {
                font-size: 13px;
            }

            .panel {
                padding: 20px;
            }

            .welcome-section h2 {
                font-size: 23px;
            }
        }

        /* MOBILE */

        @media (max-width: 480px) {
            body {
                padding: 12px 10px;
            }

            .school-header {
                gap: 7px;
                padding: 15px 9px;
                margin-bottom: 22px;
                border-radius: 14px;
            }

            .school-logo,
            .school-logo-right {
                width: 58px;
                height: 58px;
            }

            .school-header-center h1 {
                font-size: 16px;
                line-height: 1.35;
            }

            .school-header-center p {
                font-size: 11px;
                margin-top: 5px;
            }

            .school-tagline {
                font-size: 9px;
                padding: 4px 7px;
                margin-top: 7px;
            }

            .welcome-section {
                margin-bottom: 18px;
            }

            .welcome-section h2 {
                font-size: 21px;
            }

            .welcome-section p {
                font-size: 13px;
            }

            .panel {
                padding: 17px 14px;
                margin: 16px 0;
                border-radius: 14px;
            }

            .panel h2 {
                font-size: 18px;
                margin-bottom: 16px;
            }

            .pupil-info-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .info-item {
                padding: 13px;
            }

            .info-value {
                font-size: 15px;
            }

            .enrolment-card {
                padding: 15px 12px;
                border-radius: 12px;
            }

            .enrolment-heading {
                gap: 9px;
            }

            .enrolment-icon {
                width: 36px;
                height: 36px;
                font-size: 17px;
            }

            .enrolment-heading h3 {
                font-size: 15px;
            }

            .enrolment-heading p {
                font-size: 12px;
            }

            select {
                font-size: 14px;
            }

            button {
                font-size: 13px;
                padding: 12px 14px;
            }

            .logout-section {
                justify-content: stretch;
            }

            .logout-button {
                width: 100%;
            }

            .results-info {
                padding: 14px 12px;
                gap: 10px;
            }

            .results-info p {
                font-size: 13px;
            }
        }

        /* VERY SMALL PHONES */

        @media (max-width: 350px) {
            .school-header {
                gap: 4px;
                padding: 12px 6px;
            }

            .school-logo,
            .school-logo-right {
                width: 45px;
                height: 45px;
            }

            .school-header-center h1 {
                font-size: 14px;
            }

            .school-header-center p {
                font-size: 10px;
            }

            .school-tagline {
                display: none;
            }
        }

        /* ACCESSIBILITY */

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                transition: none !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>

<body>

<div class="page-container">

    <!-- SCHOOL HEADER -->

    <div class="school-header">

        <img
            src="{{ asset('images/school-logo.jpeg') }}"
            alt="Fatima Nursery and Primary School Logo"
            class="school-logo"
        >

        <div class="school-header-center">

            <h1>Fatima Nursery and Primary School</h1>

            <p>Gusau, Zamfara State</p>

            <span class="school-tagline">
                PARENT PORTAL
            </span>

        </div>

        <img
            src="{{ asset('images/second-school-logo.jpeg') }}"
            alt="School Second Logo"
            class="school-logo-right"
        >

    </div>

    <!-- WELCOME -->

    <div class="welcome-section">

        <h2>Welcome, Parent</h2>

        <p>
            View your child's information, enrolment history,
            and available academic results.
        </p>

    </div>

    <!-- SUCCESS MESSAGE -->

    @if (session('success'))

        <div class="message">
            {{ session('success') }}
        </div>

    @endif

    <!-- ERROR MESSAGE -->

    @if (session('error'))

        <div class="error">
            {{ session('error') }}
        </div>

    @endif

    <!-- PUPIL INFORMATION -->

    <div class="panel">

        <h2>👤 Pupil Information</h2>

        <div class="pupil-info-grid">

            <div class="info-item">

                <span class="info-label">
                    Pupil Name
                </span>

                <div class="info-value">

                    {{ $student->first_name }}
                    {{ $student->middle_name }}
                    {{ $student->last_name }}

                </div>

            </div>

            <div class="info-item">

                <span class="info-label">
                    Admission Number
                </span>

                <div class="info-value">

                    {{ $student->admission_number }}

                </div>

            </div>

            <div class="info-item">

                <span class="info-label">
                    Pupil Status
                </span>

                <div class="info-value">

                    <span class="status-badge">

                        {{ ucfirst($student->status) }}

                    </span>

                </div>

            </div>

        </div>

    </div>

    <!-- ENROLMENT HISTORY -->

    <div class="panel">

        <h2>📚 Enrolment History</h2>

        <p class="section-description">

            Select an academic term to download your child's
            available published results.

        </p>

        @forelse ($student->enrollments as $enrolment)

            <div class="enrolment-card">

                <div class="enrolment-heading">

                    <div class="enrolment-icon">
                        📘
                    </div>

                    <div>

                        <h3>

                            {{ $enrolment->academicSession->name }}

                        </h3>

                        <p>

                            {{ $enrolment->section->classLevel->name }}

                            {{ $enrolment->section->name }}

                        </p>

                    </div>

                </div>

                <form
                    class="result-form"
                    method="GET"
                    action="{{ route('parent.results.pdf') }}"
                >

                    <input
                        type="hidden"
                        name="session_id"
                        value="{{ $enrolment->academic_session_id }}"
                    >

                    <label for="term-{{ $enrolment->id }}">

                        Select Academic Term

                    </label>

                    <select
                        id="term-{{ $enrolment->id }}"
                        name="term"
                        required
                    >

                        <option value="">
                            Choose a term
                        </option>

                        <option value="First Term">
                            First Term
                        </option>

                        <option value="Second Term">
                            Second Term
                        </option>

                        <option value="Third Term">
                            Third Term
                        </option>

                    </select>

                    <button
                        type="submit"
                        class="download-button"
                    >

                        <span aria-hidden="true">📄</span>

                        Download My Results PDF

                    </button>

                </form>

            </div>

        @empty

            <p>
                No enrolment records are available.
            </p>

        @endforelse

    </div>

    <!-- RESULTS INFORMATION -->

    <div class="panel">

        <h2>📄 Academic Results</h2>

        <div class="results-info">

            <div class="results-info-icon">
                ℹ️
            </div>

            <p>

                Select an academic session and term from the
                enrolment history above to download your child's
                available published results.

                Results that have not been published will
                not be downloadable.

            </p>

        </div>

    </div>

    <!-- SIGN OUT -->

    <div class="logout-section">

        <form
            method="POST"
            action="{{ route('parent.logout') }}"
        >

            @csrf

            <button
                type="submit"
                class="logout-button"
            >

                Sign Out

            </button>

        </form>

    </div>

    <!-- FOOTER -->

    <div class="footer">

        Fatima Nursery and Primary School
        <br>

        Gusau, Zamfara State

    </div>

</div>

</body>
</html>
