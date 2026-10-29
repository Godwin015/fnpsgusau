<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Staff Management | FNPS Gusau</title>

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

        /* Management Grid */

        .management-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
            align-items: stretch;
            margin-bottom: 28px;
        }

        /* Panels */

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
            margin-bottom: 20px;
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
            font-size: 19px;
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

        /* Management Links */

        .management-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            min-height: 48px;
            padding: 13px 16px;
            border: 1px solid #dbeafe;
            border-radius: 11px;
            background: #edf4ff;
            color: #2453a0;
            font-size: 13px;
            font-weight: 800;
            line-height: 1.6;
            text-decoration: none;
            transition: background 0.2s, border-color 0.2s, transform 0.2s;
        }

        .management-link:hover {
            background: #dbeafe;
            border-color: #bfd5ff;
            transform: translateY(-1px);
        }

        .management-link span:last-child {
            flex-shrink: 0;
            font-size: 19px;
        }

        /* Credentials */

        .credentials-panel {
            margin-bottom: 28px;
            border-color: #bfdbfe;
            background: linear-gradient(135deg, #ffffff, #f5f9ff);
        }

        .credential-highlight {
            padding: 18px;
            border: 1px solid #dbeafe;
            border-radius: 12px;
            background: #f0f6ff;
            margin-bottom: 15px;
        }

        .credential-label {
            margin: 0 0 7px;
            color: #64748b;
            font-size: 12px;
            font-weight: 700;
        }

        .credential-value {
            margin: 0;
            color: #173f7a;
            font-size: 17px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .credential-password {
            color: #1d4ed8;
            font-size: 23px;
            letter-spacing: 1px;
        }

        .credential-note {
            margin: 0;
            color: #718096;
            font-size: 13px;
            line-height: 1.8;
        }

        /* Staff Creation */

        .staff-create-panel {
            margin-bottom: 28px;
        }

        .form-intro {
            margin: 0 0 20px;
            color: #718096;
            font-size: 13px;
            line-height: 1.8;
        }

        label.field {
            display: block;
            margin: 17px 0;
            color: #244777;
            font-size: 13px;
            font-weight: 700;
        }

        input[type="text"],
        input[type="email"],
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

        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus {
            border-color: #60a5fa;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
        }

        /* Section Assignment */

        .section-heading {
            margin: 28px 0 8px;
            color: #173f7a;
            font-size: 17px;
            font-weight: 800;
        }

        .section-intro {
            margin: 0 0 18px;
            color: #718096;
            font-size: 13px;
            line-height: 1.8;
        }

        .class-level {
            margin-top: 20px;
            padding: 17px;
            border: 1px solid #e2eaf5;
            border-radius: 13px;
            background: #f8faff;
        }

        .class-level h4 {
            margin: 0 0 13px;
            color: #244777;
            font-size: 14px;
            font-weight: 800;
        }

        .section-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 9px;
        }

        .section-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            min-width: 0;
            padding: 11px;
            border: 1px solid #e2eaf5;
            border-radius: 9px;
            background: #ffffff;
            color: #385477;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.6;
            cursor: pointer;
            overflow-wrap: anywhere;
            transition: border-color 0.2s, background 0.2s;
        }

        .section-item:hover {
            border-color: #bfd5ff;
            background: #f0f6ff;
        }

        .section-item input {
            width: 17px;
            height: 17px;
            margin: 1px 0 0;
            accent-color: #2563eb;
            flex-shrink: 0;
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

        /* Existing Staff */

        .staff-panel {
            margin-bottom: 28px;
        }

        .staff-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 30px;
            height: 30px;
            padding: 0 9px;
            border-radius: 9px;
            background: #e8f0ff;
            color: #2563eb;
            font-size: 12px;
            font-weight: 800;
            margin-left: auto;
        }

        .staff-list {
            display: flex;
            flex-direction: column;
            gap: 17px;
        }

        .staff-card {
            min-width: 0;
            padding: 21px;
            border: 1px solid #e2eaf5;
            border-radius: 15px;
            background: #f8faff;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .staff-card:hover {
            border-color: #bfd5ff;
            box-shadow: 0 5px 16px rgba(30, 64, 125, 0.05);
        }

        .staff-card h3 {
            margin: 0 0 14px;
            color: #1e4580;
            font-size: 19px;
            font-weight: 800;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .staff-detail {
            margin: 9px 0;
            color: #718096;
            font-size: 13px;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .staff-detail strong {
            color: #385477;
        }

        .staff-role {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 20px;
            background: #e8f0ff;
            color: #2453a0;
            font-size: 11px;
            font-weight: 800;
        }

        .assigned-sections {
            margin-top: 17px;
            padding: 15px;
            border: 1px solid #dbe5f2;
            border-radius: 11px;
            background: #ffffff;
        }

        .assigned-sections h4 {
            margin: 0 0 9px;
            color: #244777;
            font-size: 12px;
            font-weight: 800;
        }

        .assigned-sections p {
            margin: 0;
            color: #718096;
            font-size: 12px;
            line-height: 1.8;
            overflow-wrap: anywhere;
        }

        /* Password Reset */

        .reset-form {
            margin-top: 17px;
        }

        /* Assignment Details */

        .assignment-details {
            margin-top: 18px;
            border-top: 1px solid #e2eaf5;
            padding-top: 15px;
        }

        .assignment-details summary {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            color: #2453a0;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            list-style: none;
        }

        .assignment-details summary::-webkit-details-marker {
            display: none;
        }

        .assignment-details summary::after {
            content: "+";
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 27px;
            height: 27px;
            border-radius: 8px;
            background: #e8f0ff;
            color: #2563eb;
            font-size: 19px;
            flex-shrink: 0;
        }

        .assignment-details[open] summary::after {
            content: "−";
        }

        .assignment-form {
            margin-top: 15px;
        }

        .assignment-actions {
            margin-top: 18px;
        }

        .assignment-actions .button {
            width: 100%;
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

        /* Pagination */

        .pagination-container {
            margin-top: 25px;
            overflow-x: auto;
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
                font-size: 17px;
            }

            .staff-card {
                padding: 17px;
            }

            .section-list {
                grid-template-columns: 1fr;
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

            .panel-heading {
                gap: 10px;
            }

            .panel-icon {
                width: 42px;
                height: 42px;
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

            <h2>Staff Management</h2>

            <p>
                Manage staff accounts, pupil services, result publication
                and staff section assignments for Fatima Nursery and
                Primary School, Gusau.
            </p>

        </div>

        <!-- Welcome Banner -->

        <section class="welcome-banner">

            <h2>Staff Administration Centre</h2>

            <p>
                Welcome to the staff management area. Create staff accounts,
                manage authorised class sections, reset passwords and
                access important pupil and result management services.
                Keep staff access organized and secure.
            </p>

        </section>

        <!-- Back to Dashboard -->

        <a
            href="{{ route('staff.dashboard') }}"
            class="back-link"
        >
            <span aria-hidden="true">←</span>
            Back to Staff Dashboard
        </a>

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

        <!-- Temporary Staff Credentials -->

        @if (session('temporary_password'))

            <section class="panel credentials-panel">

                <div class="panel-heading">

                    <div class="panel-icon">
                        🔐
                    </div>

                    <div>
                        <h2>Temporary Staff Credentials</h2>
                        <p>One-time account confirmation</p>
                    </div>

                </div>

                @if (session('created_staff_email'))

                    <div class="credential-highlight">

                        <p class="credential-label">
                            New staff account
                        </p>

                        <p class="credential-value">
                            {{ session('created_staff_email') }}
                        </p>

                    </div>

                @elseif (session('reset_staff_email'))

                    <div class="credential-highlight">

                        <p class="credential-label">
                            Password reset for
                        </p>

                        <p class="credential-value">
                            {{ session('reset_staff_email') }}
                        </p>

                    </div>

                @endif

                <div class="credential-highlight">

                    <p class="credential-label">
                        Temporary password
                    </p>

                    <p class="credential-value credential-password">
                        {{ session('temporary_password') }}
                    </p>

                </div>

                <p class="credential-note">
                    Provide this password securely to the staff member.
                    It is displayed only in this one-time confirmation.
                    The staff member must change it before accessing
                    normal staff features.
                </p>

            </section>

        @endif

        <!-- Staff Management Services -->

        <div class="management-grid">

            <!-- Pupil Fee Management -->

            <section class="panel">

                <div class="panel-heading">

                    <div class="panel-icon">
                        💳
                    </div>

                    <div>
                        <h2>Pupil Fee Management</h2>
                        <p>Manage pupil fee records</p>
                    </div>

                </div>

                <p class="panel-description">
                    View pupil enrolments and update fee payment status
                    for each academic session and term.
                </p>

                <a
                    href="{{ route('staff-management.fee-statuses') }}"
                    class="management-link"
                >
                    <span>Manage Pupil Fee Statuses</span>
                    <span aria-hidden="true">→</span>
                </a>

            </section>

            <!-- Pupil Account Management -->

            <section class="panel">

                <div class="panel-heading">

                    <div class="panel-icon">
                        🔑
                    </div>

                    <div>
                        <h2>Pupil Account Management</h2>
                        <p>Manage pupil portal access</p>
                    </div>

                </div>

                <p class="panel-description">
                    Find a pupil and reset their four-digit portal PIN.
                    The pupil will be required to change the temporary
                    PIN at their next login.
                </p>

                <a
                    href="{{ route('staff-management.pupil-pin-resets') }}"
                    class="management-link"
                >
                    <span>Manage Pupil PIN Resets</span>
                    <span aria-hidden="true">→</span>
                </a>

            </section>

            <!-- Class Result Publication -->

            <section class="panel">

                <div class="panel-heading">

                    <div class="panel-icon">
                        📊
                    </div>

                    <div>
                        <h2>Class Result Publication</h2>
                        <p>Publish class results</p>
                    </div>

                </div>

                <p class="panel-description">
                    Check pupil eligibility and publish results for an
                    entire class, academic session and term.
                </p>

                <a
                    href="{{ route('staff-management.class-term-publication') }}"
                    class="management-link"
                >
                    <span>Manage Class Result Publication</span>
                    <span aria-hidden="true">→</span>
                </a>

            </section>

            <!-- Publication Audit History -->

            <section class="panel">

                <div class="panel-heading">

                    <div class="panel-icon">
                        📋
                    </div>

                    <div>
                        <h2>Publication Audit History</h2>
                        <p>Review publication records</p>
                    </div>

                </div>

                <p class="panel-description">
                    Review publication, unpublication, eligibility counts
                    and recorded reasons for publication changes.
                </p>

                <a
                    href="{{ route('staff-management.publication-audits') }}"
                    class="management-link"
                >
                    <span>View Publication Audit History</span>
                    <span aria-hidden="true">→</span>
                </a>

            </section>

            {{-- Class Subject Management --}}

            <section class="panel">

                <div class="panel-heading">

                    <div class="panel-icon">
                        📚
                    </div>

                    <div>
                        <h2>Class Subject Management</h2>
                        <p>Manage subjects offered by each class</p>
                    </div>

                </div>

                <p class="panel-description">
                    Manage the subjects available for pupils across
                    the school's class levels and sections.
                </p>

                <a
                    href="{{ route('subjects.index') }}"
                    class="management-link"
                >
                    <span>Manage Class Subjects</span>
                    <span aria-hidden="true">→</span>
                </a>

            </section>


            {{-- Progression Audit History --}}

            <section class="panel">

                <div class="panel-heading">

                    <div class="panel-icon">
                        📜
                    </div>

                    <div>
                        <h2>Progression Audit History</h2>
                        <p>Review pupil progression records</p>
                    </div>

                </div>

                <p class="panel-description">
                    Review pupil progression history and audit records
                    to track changes made during pupil promotion
                    and progression activities.
                </p>

                <a
                    href="{{ route('pupil-progression.audits') }}"
                    class="management-link"
                >
                    <span>View Progression Audit History</span>
                    <span aria-hidden="true">→</span>
                </a>

            </section>
        </div>

        <!-- Create Staff Account -->

        <section class="panel staff-create-panel">

            <div class="panel-heading">

                <div class="panel-icon">
                    👤
                </div>

                <div>
                    <h2>Create a Staff Account</h2>
                    <p>Register a Teacher</p>
                </div>

            </div>

            <p class="form-intro">
                Enter the staff member's details, select their role
                and assign every section they are authorised to work with.
            </p>

            <form
                method="POST"
                action="{{ route('staff-management.store') }}"
            >

                @csrf

                <label class="field">

                    Full name

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        maxlength="255"
                        required
                    >

                </label>

                <label class="field">

                    Email address

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        maxlength="255"
                        required
                    >

                </label>

                <label class="field">

                    Staff role

                    <select name="role" required>

                        <option value="">
                            Select a role
                        </option>

                        <option
                            value="teacher"
                            @selected(old('role') === 'teacher')
                        >
                            Teacher
                        </option>

                        <option
                            value="result_officer"
                            @selected(old('role') === 'result_officer')
                        >
                            Result Officer
                        </option>

                    </select>

                </label>

                <h3 class="section-heading">
                    Assign Sections
                </h3>

                <p class="section-intro">
                    Select every section this staff member is authorised
                    to work with.
                </p>

                @foreach ($classLevels as $classLevel)

                    <div class="class-level">

                        <h4>
                            {{ $classLevel->name }}
                        </h4>

                        <div class="section-list">

                            @foreach ($classLevel->sections as $section)

                                <label class="section-item">

                                    <input
                                        type="checkbox"
                                        name="section_ids[]"
                                        value="{{ $section->id }}"
                                        @checked(in_array(
                                            (string) $section->id,
                                            array_map(
                                                'strval',
                                                old('section_ids', [])
                                            )
                                        ))
                                    >

                                    <span>
                                        {{ $section->name }}
                                    </span>

                                </label>

                            @endforeach

                        </div>

                    </div>

                @endforeach

                <button
                    type="submit"
                    class="button button-primary"
                >

                    <span aria-hidden="true">＋</span>
                    Create Staff Account

                </button>

            </form>

        </section>

        <!-- Existing Staff -->

        <section class="panel staff-panel">

            <div class="panel-heading">

                <div class="panel-icon">
                    👥
                </div>

                <div>
                    <h2>Existing Staff</h2>
                    <p>Manage staff accounts and assignments</p>
                </div>

                <span class="staff-count">
                    {{ $staffMembers->count() }}
                </span>

            </div>

            @forelse ($staffMembers as $staff)

                <div class="staff-list">

                    <article class="staff-card">

                        <!-- Staff Information -->

                        <h3>
                            {{ $staff->name }}
                        </h3>

                        <p class="staff-detail">

                            <strong>Email:</strong>

                            {{ $staff->email }}

                        </p>

                        <p class="staff-detail">

                            <strong>Role:</strong>

                            <span class="staff-role">

                                {{ ucfirst(str_replace('_', ' ', $staff->role)) }}

                            </span>

                        </p>

                        <!-- Reset Staff Password -->

                        <form
                            class="reset-form"
                            method="POST"
                            action="{{ route('staff-management.password.reset', $staff) }}"
                            onsubmit="return confirm('Reset the password for {{ addslashes($staff->name) }}?');"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="button button-danger"
                            >

                                🔐 Reset Staff Password

                            </button>

                        </form>

                        <!-- Current Assignments -->

                        <div class="assigned-sections">

                            <h4>
                                Currently Assigned Sections
                            </h4>

                            <p>

                                @forelse ($staff->assignedSections as $assignedSection)

                                    {{ $assignedSection->classLevel->name }}
                                    {{ $assignedSection->name }}@if (!$loop->last), @endif

                                @empty

                                    No sections assigned

                                @endforelse

                            </p>

                        </div>

                        <!-- Change Section Assignments -->

                        <details class="assignment-details">

                            <summary>
                                Change section assignments
                            </summary>

                            <form
                                class="assignment-form"
                                method="POST"
                                action="{{ route('staff-management.assignments.update', $staff) }}"
                            >

                                @csrf

                                @method('PUT')

                                @foreach ($classLevels as $classLevel)

                                    <div class="class-level">

                                        <h4>
                                            {{ $classLevel->name }}
                                        </h4>

                                        <div class="section-list">

                                            @foreach ($classLevel->sections as $section)

                                                <label class="section-item">

                                                    <input
                                                        type="checkbox"
                                                        name="section_ids[]"
                                                        value="{{ $section->id }}"
                                                        @checked(
                                                            $staff->assignedSections->contains(
                                                                'id',
                                                                $section->id
                                                            )
                                                        )
                                                    >

                                                    <span>
                                                        {{ $section->name }}
                                                    </span>

                                                </label>

                                            @endforeach

                                        </div>

                                    </div>

                                @endforeach

                                <div class="assignment-actions">

                                    <button
                                        type="submit"
                                        class="button button-secondary"
                                    >

                                        Save Assignments

                                    </button>

                                </div>

                            </form>

                        </details>

                    </article>

                </div>

            @empty

                <div class="empty-state">

                    <div class="empty-icon">
                        👥
                    </div>

                    <h3>
                        No Staff Accounts Yet
                    </h3>

                    <p>
                        No teacher or result-officer accounts have
                        been created yet. Use the form above to
                        create your first staff account.
                    </p>

                </div>

            @endforelse

            <!-- Pagination -->

            <div class="pagination-container">

                {{ $staffMembers->links() }}

            </div>

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

</body>
</html>