<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Academic Sessions | FNPS Gusau</title>

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
            max-width: 650px;
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

        /* Main Grid */

        .sessions-grid {
            display: grid;
            grid-template-columns: minmax(0, 0.9fr) minmax(0, 1.3fr);
            gap: 25px;
            align-items: start;
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

        /* Form */

        .form-intro {
            margin: 0 0 20px;
            color: #718096;
            font-size: 13px;
            line-height: 1.7;
        }

        label {
            display: block;
            margin-top: 17px;
            color: #244777;
            font-size: 13px;
            font-weight: 700;
        }

        input[type="text"],
        input[type="date"] {
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
        input[type="date"]:focus {
            border-color: #60a5fa;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
        }

        /* Current Session Checkbox */

        .current-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-top: 23px;
            padding: 15px;
            border: 1px solid #dbeafe;
            border-radius: 12px;
            background: #f0f6ff;
        }

        .current-checkbox input {
            width: 18px;
            height: 18px;
            margin: 2px 0 0;
            accent-color: #2563eb;
            flex-shrink: 0;
        }

        .current-checkbox label {
            margin: 0;
            color: #244777;
            font-size: 13px;
            line-height: 1.6;
            cursor: pointer;
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

        /* Session List */

        .session-count {
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
        }

        .session-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .session-card {
            min-width: 0;
            padding: 20px;
            border: 1px solid #e2eaf5;
            border-radius: 15px;
            background: #f8faff;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .session-card:hover {
            border-color: #bfd5ff;
            box-shadow: 0 5px 16px rgba(30, 64, 125, 0.05);
        }

        .session-card.is-current {
            border-color: #93c5fd;
            background: linear-gradient(135deg, #f0f6ff, #ffffff);
        }

        .session-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .session-name {
            margin: 0;
            color: #1e4580;
            font-size: 19px;
            font-weight: 800;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .current-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            flex-shrink: 0;
            padding: 7px 10px;
            border-radius: 20px;
            background: #dcfce7;
            color: #166534;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .current-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #16a34a;
        }

        .session-date {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 13px 0 18px;
            color: #718096;
            font-size: 13px;
            line-height: 1.7;
        }

        .session-date svg {
            width: 17px;
            height: 17px;
            color: #2563eb;
            flex-shrink: 0;
        }

        /* Edit Section */

        .edit-details {
            border-top: 1px solid #e2eaf5;
            padding-top: 15px;
        }

        .edit-details summary {
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

        .edit-details summary::-webkit-details-marker {
            display: none;
        }

        .edit-details summary::after {
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

        .edit-details[open] summary::after {
            content: "−";
        }

        .edit-form {
            margin-top: 15px;
        }

        .edit-form label {
            margin-top: 14px;
        }

        .edit-form .current-checkbox {
            margin-top: 18px;
        }

        .edit-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 18px;
        }

        .edit-actions .button {
            width: 100%;
        }

        .delete-form {
            margin-top: 12px;
        }

        .delete-form .button {
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
            .sessions-grid {
                grid-template-columns: 1fr;
            }

            .create-panel {
                order: 1;
            }

            .existing-panel {
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

            .panel-heading h2 {
                font-size: 18px;
            }

            .session-card {
                padding: 17px;
            }

            .session-top {
                flex-direction: column;
                align-items: flex-start;
            }

            .current-badge {
                margin-top: 2px;
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
            <h2>Academic Session Management</h2>

            <p>
                Create, organize and manage the academic sessions
                of Fatima Nursery and Primary School, Gusau.
            </p>
        </div>

        <!-- Success Message -->

        @if (session('success'))
            <div class="message success" role="status">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->

        @if (session('error'))
            <div class="message error" role="alert">
                {{ session('error') }}
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

            <h2>Manage Your Academic Calendar</h2>

            <p>
                Set up school academic sessions, define their dates
                and choose which session is currently active.
                Keep your school records organized throughout
                the academic year.
            </p>

        </section>
           <!-- Back to Dashboard -->

        <a href="{{ route('staff.dashboard') }}" class="back-link">
            <span aria-hidden="true">←</span>
            Back to Staff Dashboard
        </a>

        <!-- Sessions Layout -->

        <div class="sessions-grid">

            <!-- Create Academic Session -->

            <section class="panel create-panel">

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
                            <rect x="3" y="5" width="18" height="16" rx="2"/>
                            <path d="M16 3v4"/>
                            <path d="M8 3v4"/>
                            <path d="M3 11h18"/>
                            <path d="M8 15h2"/>
                            <path d="M14 15h2"/>
                        </svg>

                    </div>

                    <div>
                        <h2>Create Session</h2>
                        <p>Add a new academic year</p>
                    </div>

                </div>

                <p class="form-intro">
                    Enter the academic session name and dates below.
                </p>

                <form
                    method="POST"
                    action="{{ route('academic-sessions.store') }}"
                >

                    @csrf

                    <label for="name">
                        Academic Session Name
                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        placeholder="e.g. 2026/2027"
                        value="{{ old('name') }}"
                        required
                        maxlength="20"
                    >

                    <label for="start_date">
                        Session Start Date
                    </label>

                    <input
                        id="start_date"
                        type="date"
                        name="start_date"
                        value="{{ old('start_date') }}"
                        required
                    >

                    <label for="end_date">
                        Session End Date
                    </label>

                    <input
                        id="end_date"
                        type="date"
                        name="end_date"
                        value="{{ old('end_date') }}"
                        required
                    >

                    <div class="current-checkbox">

                        <input
                            id="create_is_current"
                            type="checkbox"
                            name="is_current"
                            value="1"
                            @checked(old('is_current'))
                        >

                        <label for="create_is_current">
                            Set as the current academic session
                        </label>

                    </div>

                    <button type="submit" class="button button-primary">

                        <span aria-hidden="true">＋</span>
                        Create Academic Session

                    </button>

                </form>

            </section>

            <!-- Existing Sessions -->

            <section class="panel existing-panel">

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
                        <h2>Existing Sessions</h2>
                        <p>View and manage school academic years</p>
                    </div>

                    <span class="session-count">
                        {{ $sessions->count() }}
                    </span>

                </div>

                @if ($sessions->isEmpty())

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
                                <rect x="3" y="5" width="18" height="16" rx="2"/>
                                <path d="M16 3v4"/>
                                <path d="M8 3v4"/>
                                <path d="M3 11h18"/>
                            </svg>

                        </div>

                        <h3>No Academic Sessions Yet</h3>

                        <p>
                            Create your first academic session using
                            the form. Your sessions will appear here
                            once they have been created.
                        </p>

                    </div>

                @else

                    <div class="session-list">

                        @foreach ($sessions as $session)

                            <article
                                class="session-card {{ $session->is_current ? 'is-current' : '' }}"
                            >

                                <!-- Session Information -->

                                <div class="session-top">

                                    <h3 class="session-name">
                                        {{ $session->name }}
                                    </h3>

                                    @if ($session->is_current)

                                        <span class="current-badge">

                                            <span class="current-dot"></span>

                                            CURRENT SESSION

                                        </span>

                                    @endif

                                </div>

                                <!-- Session Dates -->

                                <div class="session-date">

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
                                        <rect x="3" y="5" width="18" height="16" rx="2"/>
                                        <path d="M16 3v4"/>
                                        <path d="M8 3v4"/>
                                        <path d="M3 11h18"/>
                                    </svg>

                                    <span>
                                        {{ $session->start_date->format('d M Y') }}
                                        —
                                        {{ $session->end_date->format('d M Y') }}
                                    </span>

                                </div>

                                <!-- Edit Session -->

                                <details class="edit-details">

                                    <summary>
                                        Edit Academic Session
                                    </summary>

                                    <form
                                        class="edit-form"
                                        method="POST"
                                        action="{{ route('academic-sessions.update', $session) }}"
                                    >

                                        @csrf
                                        @method('PUT')

                                        <label>
                                            Academic Session Name
                                        </label>

                                        <input
                                            type="text"
                                            name="name"
                                            value="{{ $session->name }}"
                                            required
                                            maxlength="20"
                                        >

                                        <label>
                                            Session Start Date
                                        </label>

                                        <input
                                            type="date"
                                            name="start_date"
                                            value="{{ $session->start_date->format('Y-m-d') }}"
                                            required
                                        >

                                        <label>
                                            Session End Date
                                        </label>

                                        <input
                                            type="date"
                                            name="end_date"
                                            value="{{ $session->end_date->format('Y-m-d') }}"
                                            required
                                        >

                                        <div class="current-checkbox">

                                            <input
                                                id="current_session_{{ $session->id }}"
                                                type="checkbox"
                                                name="is_current"
                                                value="1"
                                                @checked($session->is_current)
                                            >

                                            <label
                                                for="current_session_{{ $session->id }}"
                                            >
                                                Set as current academic session
                                            </label>

                                        </div>

                                        <div class="edit-actions">

                                            <button
                                                type="submit"
                                                class="button button-secondary"
                                            >
                                                Save Changes
                                            </button>

                                        </div>

                                    </form>

                                </details>

                                <!-- Delete Session -->

                                <form
                                    class="delete-form"
                                    method="POST"
                                    action="{{ route('academic-sessions.destroy', $session) }}"
                                    onsubmit="return confirm('Delete this academic session?');"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="button button-danger"
                                    >
                                        Delete Session
                                    </button>

                                </form>

                            </article>

                        @endforeach

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