<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pupil PIN Reset | FNPS Gusau</title>

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

        /* Main Panels */

        .management-grid {
            display: grid;
            grid-template-columns: minmax(0, 0.85fr) minmax(0, 1.5fr);
            gap: 25px;
            align-items: start;
        }

        .panel {
            min-width: 0;
            background: #ffffff;
            border: 1px solid #e2eaf5;
            border-radius: 18px;
            padding: 25px;
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

        .panel-description {
            margin: 0 0 20px;
            color: #718096;
            font-size: 13px;
            line-height: 1.8;
        }

        /* Search Form */

        label {
            display: block;
            margin-top: 17px;
            color: #244777;
            font-size: 13px;
            font-weight: 700;
        }

        input[type="search"] {
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

        input[type="search"]:focus {
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
            width: 100%;
            margin-top: 22px;
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

        /* Search Tips */

        .search-tip {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            margin-top: 22px;
            padding: 15px;
            border: 1px solid #dbeafe;
            border-radius: 12px;
            background: #f0f6ff;
        }

        .search-tip-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 9px;
            background: #e0ebff;
            color: #2563eb;
            flex-shrink: 0;
        }

        .search-tip-icon svg {
            width: 17px;
            height: 17px;
        }

        .search-tip p {
            margin: 0;
            color: #526b91;
            font-size: 12px;
            line-height: 1.8;
        }

        /* Temporary PIN Confirmation */

        .pin-panel {
            margin-bottom: 25px;
            border: 1px solid #bfdbfe;
            border-radius: 18px;
            padding: 25px;
            background: linear-gradient(135deg, #eff6ff, #ffffff);
            box-shadow: 0 8px 25px rgba(30, 64, 125, 0.07);
        }

        .pin-heading {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 20px;
        }

        .pin-heading h2 {
            margin: 0;
            color: #173f7a;
            font-size: 20px;
            font-weight: 800;
        }

        .pin-heading p {
            margin: 5px 0 0;
            color: #8290a5;
            font-size: 13px;
            line-height: 1.5;
        }

        .pin-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: #dbeafe;
            color: #2563eb;
            flex-shrink: 0;
        }

        .pin-icon svg {
            width: 25px;
            height: 25px;
        }

        .pin-details {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 20px;
        }

        .pin-detail {
            min-width: 0;
            padding: 15px;
            border: 1px solid #e2eaf5;
            border-radius: 12px;
            background: #ffffff;
        }

        .pin-detail-label {
            display: block;
            margin-bottom: 7px;
            color: #718096;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }

        .pin-detail-value {
            display: block;
            color: #244777;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .temporary-pin {
            display: block;
            margin-top: 5px;
            color: #1d4ed8;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: 4px;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .pin-security-note {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 15px;
            border: 1px solid #bfdbfe;
            border-radius: 12px;
            background: #eff6ff;
        }

        .security-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 9px;
            background: #dbeafe;
            color: #2563eb;
            flex-shrink: 0;
        }

        .security-icon svg {
            width: 17px;
            height: 17px;
        }

        .pin-security-note p {
            margin: 0;
            color: #526b91;
            font-size: 12px;
            line-height: 1.8;
        }

        /* Pupil List */

        .pupils-panel {
            margin-top: 25px;
        }

        .pupil-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            height: 32px;
            padding: 0 10px;
            border-radius: 9px;
            background: #e8f0ff;
            color: #2563eb;
            font-size: 12px;
            font-weight: 800;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
            border: 1px solid #e2eaf5;
            border-radius: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
        }

        th,
        td {
            padding: 15px;
            border-bottom: 1px solid #e8eef7;
            text-align: left;
            vertical-align: middle;
            font-size: 13px;
        }

        th {
            background: #edf4ff;
            color: #244777;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        tbody tr {
            transition: background 0.2s;
        }

        tbody tr:hover {
            background: #f8faff;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .pupil-name {
            display: block;
            color: #244777;
            font-size: 13px;
            font-weight: 800;
            line-height: 1.7;
        }

        .admission-number {
            color: #526b91;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        /* Account Status */

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 800;
            line-height: 1.5;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .status-available {
            background: #dcfce7;
            color: #166534;
        }

        .status-available .status-dot {
            background: #16a34a;
        }

        .status-change {
            background: #fef3c7;
            color: #92400e;
        }

        .status-change .status-dot {
            background: #d97706;
        }

        .status-missing {
            background: #f1f5f9;
            color: #64748b;
        }

        .status-missing .status-dot {
            background: #94a3b8;
        }

        /* Reset Form */

        .reset-form {
            margin: 0;
        }

        .reset-form .button {
            width: 100%;
            min-width: 105px;
            white-space: nowrap;
        }

        .cannot-reset {
            color: #94a3b8;
            font-size: 12px;
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

        .pagination-wrap {
            margin-top: 22px;
            overflow-x: auto;
        }

        .pagination-wrap nav {
            display: flex;
            justify-content: center;
        }

        .pagination-wrap svg {
            width: 17px;
            height: 17px;
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
            .management-grid {
                grid-template-columns: 1fr;
            }

            .search-panel {
                order: 1;
            }

            .pupils-panel {
                order: 2;
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

            .panel-heading h2,
            .pin-heading h2 {
                font-size: 18px;
            }

            .pin-panel {
                padding: 20px;
            }

            .pin-details {
                grid-template-columns: 1fr;
            }

            .temporary-pin {
                font-size: 24px;
            }

            th,
            td {
                padding: 12px;
            }

            .reset-form .button {
                min-width: 95px;
                padding: 10px 12px;
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

            .pin-panel {
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
            <h2>Pupil PIN Management</h2>

            <p>
                Search pupil accounts, check their login status and securely
                reset pupil PINs when necessary.
            </p>
        </div>

        <!-- Back to Staff Management -->

        <a
            href="{{ route('staff-management.index') }}"
            class="back-link"
        >
            <span aria-hidden="true">←</span>
            Back to Staff Management
        </a>

        <!-- Success Message -->

        @if (session('success'))
            <div class="message success" role="status">
                <strong>{{ session('success') }}</strong>
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

            <h2>Secure Pupil Account Access</h2>

            <p>
                Find a pupil using their admission number or name.
                Review their account status and generate a temporary
                PIN when a reset is required. Temporary PINs should
                only be shared directly with the pupil or their
                authorised guardian through a secure method.
            </p>

        </section>

        <!-- Temporary PIN Confirmation -->

        @if (session('temporary_pupil_pin'))

            <section class="pin-panel">

                <div class="pin-heading">

                    <div class="pin-icon">
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
                            <rect x="3" y="11" width="18" height="10" rx="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            <path d="M12 15v2"/>
                        </svg>
                    </div>

                    <div>
                        <h2>Temporary Pupil PIN</h2>
                        <p>One-time reset confirmation</p>
                    </div>

                </div>

                <div class="pin-details">

                    <div class="pin-detail">

                        <span class="pin-detail-label">
                            Pupil Name
                        </span>

                        <span class="pin-detail-value">
                            {{ session('reset_pupil_name') }}
                        </span>

                    </div>

                    <div class="pin-detail">

                        <span class="pin-detail-label">
                            Admission Number
                        </span>

                        <span class="pin-detail-value">
                            {{ session('reset_pupil_admission') }}
                        </span>

                    </div>

                    <div class="pin-detail" style="grid-column: 1 / -1;">

                        <span class="pin-detail-label">
                            Temporary PIN
                        </span>

                        <strong class="temporary-pin">
                            {{ session('temporary_pupil_pin') }}
                        </strong>

                    </div>

                </div>

                <div class="pin-security-note">

                    <div class="security-icon">
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
                            <path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/>
                            <path d="m9 12 2 2 4-4"/>
                        </svg>
                    </div>

                    <p>
                        Give this PIN directly to the pupil or their authorised
                        guardian using a secure method. It is displayed only
                        in this one-time confirmation. The pupil must change
                        it at the next login.
                    </p>

                </div>

            </section>

        @endif

        <!-- Search and Pupil List -->

        <div class="management-grid">

            <!-- Search Panel -->

            <section class="panel search-panel">

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
                        </svg>
                    </div>

                    <div>
                        <h2>Find a Pupil</h2>
                        <p>Search pupil records</p>
                    </div>

                </div>

                <p class="panel-description">
                    Enter the pupil's admission number or name to
                    locate their account and check their PIN status.
                </p>

                <form
                    method="GET"
                    action="{{ route('staff-management.pupil-pin-resets') }}"
                >

                    <label for="search">
                        Admission Number or Pupil Name
                    </label>

                    <input
                        id="search"
                        type="search"
                        name="search"
                        value="{{ $search }}"
                        maxlength="100"
                        placeholder="e.g. FNPS-2026-123456 or pupil name"
                    >

                    <button
                        type="submit"
                        class="button button-primary"
                    >
                        <span aria-hidden="true">⌕</span>
                        Search Pupils
                    </button>

                </form>

                <div class="search-tip">

                    <div class="search-tip-icon">
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
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M12 11v5"/>
                            <path d="M12 8h.01"/>
                        </svg>
                    </div>

                    <p>
                        <strong>Search tip:</strong>
                        You can search using a pupil's admission number,
                        surname, first name or other matching name details.
                    </p>

                </div>

            </section>

            <!-- Pupil List Panel -->

            <section class="panel pupils-panel">

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
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>

                    <div>
                        <h2>Pupil Accounts</h2>
                        <p>Account status and PIN reset</p>
                    </div>

                    <span class="pupil-count">
                        {{ $students->count() }}
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
                                <circle cx="11" cy="11" r="7"/>
                                <path d="m20 20-4-4"/>
                                <path d="M8 11h6"/>
                            </svg>
                        </div>

                        <h3>No Pupils Found</h3>

                        <p>
                            No pupils were found matching your search.
                            Try another admission number or pupil name.
                        </p>

                    </div>

                @else

                    <div class="table-wrap">

                        <table>

                            <thead>
                                <tr>
                                    <th>Pupil</th>
                                    <th>Admission Number</th>
                                    <th>Account Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($students as $student)

                                    @php
                                        $account = $accounts->get($student->id);
                                    @endphp

                                    <tr>

                                        <!-- Pupil Name -->

                                        <td>
                                            <span class="pupil-name">
                                                {{ $student->last_name }},
                                                {{ $student->first_name }}
                                                {{ $student->middle_name }}
                                            </span>
                                        </td>

                                        <!-- Admission Number -->

                                        <td>
                                            <span class="admission-number">
                                                {{ $student->admission_number }}
                                            </span>
                                        </td>

                                        <!-- Account Status -->

                                        <td>

                                            @if ($account)

                                                @if ($account->must_change_pin)

                                                    <span class="status-badge status-change">
                                                        <span class="status-dot"></span>
                                                        PIN change required
                                                    </span>

                                                @else

                                                    <span class="status-badge status-available">
                                                        <span class="status-dot"></span>
                                                        Account available
                                                    </span>

                                                @endif

                                            @else

                                                <span class="status-badge status-missing">
                                                    <span class="status-dot"></span>
                                                    No pupil login account
                                                </span>

                                            @endif

                                        </td>

                                        <!-- Reset PIN Action -->

                                        <td>

                                            @if ($account)

                                                <form
                                                    class="reset-form"
                                                    method="POST"
                                                    action="{{ route('staff-management.pupil-pin-resets.reset', $student) }}"
                                                    onsubmit="return confirm('Reset the PIN for this pupil? The existing PIN will stop working.');"
                                                >

                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="button button-danger"
                                                    >
                                                        Reset PIN
                                                    </button>

                                                </form>

                                            @else

                                                <span class="cannot-reset">
                                                    Cannot reset
                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="4">
                                            No pupils found matching your search.
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <!-- Pagination -->

                    <div class="pagination-wrap">
                        {{ $students->links() }}
                    </div>

                @endif

            </section>

        </div>

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
