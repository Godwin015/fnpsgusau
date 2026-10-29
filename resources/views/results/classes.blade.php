<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Classes and Results | FNPS Gusau</title>

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
            line-height: 1.7;
        }

        /* Dashboard Navigation */

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

        /* Panels */

        .panel {
            background: #ffffff;
            border: 1px solid #e2eaf5;
            border-radius: 18px;
            padding: 27px;
            margin-bottom: 27px;
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

        /* Academic Session Form */

        .selection-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .form-group {
            min-width: 0;
        }

        label {
            display: block;
            margin-bottom: 9px;
            color: #243b60;
            font-size: 14px;
            font-weight: 700;
        }

        select {
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
            cursor: pointer;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        select:focus {
            border-color: #2563eb;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        /* Buttons */

        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 24px;
        }

        .primary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 13px 22px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #1d4ed8, #123f91);
            color: #ffffff;
            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 6px 16px rgba(29, 78, 216, 0.20);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .primary-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 9px 22px rgba(29, 78, 216, 0.28);
        }

        .primary-button:focus-visible,
        .back-button:focus-visible {
            outline: 3px solid #93c5fd;
            outline-offset: 3px;
        }

        /* Current Session Information */

        .session-banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            padding: 19px 23px;
            margin-bottom: 27px;
            border-radius: 14px;
            background: linear-gradient(135deg, #1d4ed8, #123f91);
            color: #ffffff;
            box-shadow: 0 9px 23px rgba(29, 78, 216, 0.15);
        }

        .session-banner h3 {
            margin: 0;
            font-size: 17px;
            font-weight: 800;
        }

        .session-banner p {
            margin: 6px 0 0;
            color: #dbeafe;
            font-size: 13px;
            line-height: 1.6;
        }

        .session-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 9px 13px;
            border-radius: 9px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        /* Class Grid */

        .classes-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .class-card {
            background: #ffffff;
            border: 1px solid #e2eaf5;
            border-radius: 17px;
            padding: 23px;
            box-shadow: 0 8px 25px rgba(30, 64, 125, 0.06);
            transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
        }

        .class-card:hover {
            transform: translateY(-3px);
            border-color: #c7d9f5;
            box-shadow: 0 12px 28px rgba(30, 64, 125, 0.10);
        }

        .class-card-header {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 18px;
        }

        .class-icon {
            width: 52px;
            height: 52px;
            border-radius: 13px;
            background: #e8f0ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .class-icon svg {
            width: 27px;
            height: 27px;
        }

        .class-card h3 {
            margin: 0;
            color: #1e4580;
            font-size: 19px;
            font-weight: 800;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .class-card .section-name {
            margin: 5px 0 0;
            color: #718096;
            font-size: 13px;
        }

        .class-card-description {
            margin: 0 0 20px;
            color: #718096;
            font-size: 13px;
            line-height: 1.7;
        }

        .class-card-footer {
            padding-top: 17px;
            border-top: 1px solid #edf2f8;
        }

        .view-pupils-button {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            width: 100%;
            padding: 13px 16px;
            border-radius: 10px;
            background: #edf4ff;
            border: 1px solid #d6e5ff;
            color: #1e4f9a;
            text-decoration: none;
            font-size: 14px;
            font-weight: 800;
            transition: background 0.2s, border-color 0.2s;
        }

        .view-pupils-button:hover {
            background: #dceaff;
            border-color: #b8d2ff;
        }

        .link-arrow {
            color: #2563eb;
            font-size: 20px;
            flex-shrink: 0;
        }

        /* Empty State */

        .empty-state {
            padding: 32px 20px;
            text-align: center;
            background: #f8faff;
            border: 1px dashed #cbd9eb;
            border-radius: 14px;
        }

        .empty-state-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            background: #e8f0ff;
            color: #2563eb;
        }

        .empty-state-icon svg {
            width: 29px;
            height: 29px;
        }

        .empty-state h3 {
            margin: 0 0 10px;
            color: #244777;
            font-size: 17px;
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

        @media (max-width: 850px) {
            .classes-grid {
                grid-template-columns: 1fr;
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
                gap: 20px;
            }

            .form-actions .primary-button {
                width: 100%;
            }

            .session-banner {
                align-items: flex-start;
                flex-direction: column;
                padding: 20px;
            }

            .class-card {
                padding: 20px;
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

            .class-card {
                padding: 17px;
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
                <h2>Classes and Results</h2>

                <p>
                    Select an academic session and term to view pupils,
                    manage results and access result reports.
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

        <!-- Academic Session Selection -->

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
                        <rect x="3" y="4" width="18" height="17" rx="2"/>
                        <path d="M16 2v4"/>
                        <path d="M8 2v4"/>
                        <path d="M3 10h18"/>
                        <path d="M8 14h3"/>
                        <path d="M8 17h5"/>
                    </svg>
                </div>

                <div>
                    <h2>Select Academic Session</h2>
                    <p>Choose the term and academic session you want to view</p>
                </div>

            </div>

            <form
                method="GET"
                action="{{ route('results.classes') }}"
            >

                <div class="selection-grid">

                    <div class="form-group">

                        <label for="term">Academic Term</label>

                        <select
                            name="term"
                            id="term"
                            required
                        >

                            @foreach ($terms as $term)

                                <option
                                    value="{{ $term }}"
                                    @selected(
                                        request('term', 'First Term') === $term
                                    )
                                >
                                    {{ $term }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="form-group">

                        <label for="session_id">Academic Session</label>

                        <select
                            name="session_id"
                            id="session_id"
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

                </div>

                <div class="form-actions">

                    <button
                        type="submit"
                        class="primary-button"
                    >
                        Choose Session
                        <span aria-hidden="true">→</span>
                    </button>

                </div>

            </form>

        </section>

        <!-- Session Information -->

        @if (
            request('session_id') &&
            $sessions->contains('id', (int) request('session_id'))
        )

            @php
                $chosenSession = $sessions->firstWhere(
                    'id',
                    (int) request('session_id')
                );
            @endphp

            <div class="session-banner">

                <div>
                    <h3>Selected Academic Session</h3>

                    <p>
                        {{ $chosenSession->name }}
                        · {{ request('term', 'First Term') }}
                    </p>
                </div>

                <span class="session-badge">
                    Selected Session
                </span>

            </div>

        @elseif ($currentSession)

            <div class="session-banner">

                <div>
                    <h3>Current Academic Session</h3>

                    <p>
                        {{ $currentSession->name }}
                        · {{ request('term', 'First Term') }}
                    </p>
                </div>

                <span class="session-badge">
                    Current Session
                </span>

            </div>

        @endif

        <!-- Available Classes and Sections -->

        <section>

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
                        <path d="M12 3 3 8v2h18V8l-9-5Z"/>
                        <path d="M5 10v8"/>
                        <path d="M9 10v8"/>
                        <path d="M15 10v8"/>
                        <path d="M19 10v8"/>
                        <path d="M3 20h18"/>
                    </svg>
                </div>

                <div>
                    <h2>Available Classes and Sections</h2>
                    <p>Select a class to view its pupils and results</p>
                </div>

            </div>

            @forelse ($sections as $section)

                <article class="class-card">

                    <div class="class-card-header">

                        <div class="class-icon">
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
                            <h3>
                                {{ $section->classLevel->name }}
                            </h3>

                            <p class="section-name">
                                Section: {{ $section->name }}
                            </p>
                        </div>

                    </div>

                    <p class="class-card-description">
                        View pupils enrolled in this class and access
                        their academic results for the selected term.
                    </p>

                    <div class="class-card-footer">

                        @if (
                            request('session_id') &&
                            $sessions->contains(
                                'id',
                                (int) request('session_id')
                            )
                        )

                            <a
                                href="{{ route('results.students', [
                                    'section' => $section->id,
                                    'session_id' => request('session_id'),
                                    'term' => request('term', 'First Term'),
                                ]) }}"
                                class="view-pupils-button"
                            >

                                <span>View Pupils</span>

                                <span
                                    class="link-arrow"
                                    aria-hidden="true"
                                >›</span>

                            </a>

                        @elseif ($currentSession)

                            <a
                                href="{{ route('results.students', [
                                    'section' => $section->id,
                                    'session_id' => $currentSession->id,
                                    'term' => request('term', 'First Term'),
                                ]) }}"
                                class="view-pupils-button"
                            >

                                <span>View Pupils in Current Session</span>

                                <span
                                    class="link-arrow"
                                    aria-hidden="true"
                                >›</span>

                            </a>

                        @else

                            <div class="empty-state">

                                <h3>Academic Session Required</h3>

                                <p>
                                    Please create and select an academic
                                    session first.
                                </p>

                            </div>

                        @endif

                    </div>

                </article>

            @empty

                <div class="empty-state">

                    <div class="empty-state-icon">
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
                            <path d="M12 3 3 8v2h18V8l-9-5Z"/>
                            <path d="M5 10v8"/>
                            <path d="M9 10v8"/>
                            <path d="M15 10v8"/>
                            <path d="M19 10v8"/>
                            <path d="M3 20h18"/>
                        </svg>
                    </div>

                    <h3>No Classes Available</h3>

                    <p>
                        No sections are available to your account.
                        Please contact the Super Admin if you need assistance.
                    </p>

                </div>

            @endforelse

        </section>

    </main>

    <!-- Footer -->

    <footer class="footer">
        &copy; {{ date('Y') }}
        <strong>Fatima Nursery and Primary School, Gusau</strong>.
        All rights reserved.
    </footer>

</body>
</html>
