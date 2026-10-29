<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Staff Dashboard | FNPS Gusau</title>

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

        /* Header */

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

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 35px 22px 50px;
        }

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
            line-height: 1.6;
        }

        /* Messages */

        .message {
            padding: 14px 18px;
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

        /* Staff Profile */

        .profile-card {
            background: linear-gradient(135deg, #1d4ed8, #123f91);
            color: #ffffff;
            border-radius: 20px;
            padding: 28px;
            margin-bottom: 30px;
            box-shadow: 0 12px 30px rgba(29, 78, 216, 0.18);
        }

        .profile-top {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 24px;
        }

        .profile-avatar {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .profile-avatar svg {
            width: 34px;
            height: 34px;
        }

        .profile-top h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .profile-top p {
            margin: 7px 0 0;
            color: #dbeafe;
            font-size: 14px;
        }

        .profile-details {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .profile-detail {
            padding: 15px 17px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.16);
            overflow-wrap: anywhere;
        }

        .profile-detail span {
            display: block;
            color: #bfdbfe;
            font-size: 12px;
            margin-bottom: 7px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .profile-detail strong {
            font-size: 15px;
            color: #ffffff;
        }

        /* Dashboard Cards */

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 24px;
            align-items: start;
        }

        .panel {
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
            margin-bottom: 22px;
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
        }

        /* Navigation Links */

        .dashboard-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 15px 16px;
            margin-bottom: 12px;
            background: #f8faff;
            border: 1px solid #e4ecf8;
            border-radius: 11px;
            color: #244777;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.5;
            transition: background 0.2s, border-color 0.2s, transform 0.2s;
        }

        .dashboard-link:last-child {
            margin-bottom: 0;
        }

        .dashboard-link:hover {
            background: #edf4ff;
            border-color: #b8d2ff;
            transform: translateY(-1px);
        }

        .link-arrow {
            color: #2563eb;
            font-size: 20px;
            flex-shrink: 0;
        }

        /* Assigned Sections */

        .section-card {
            padding: 18px;
            margin-bottom: 16px;
            background: #f8faff;
            border: 1px solid #e2eaf5;
            border-radius: 13px;
        }

        .section-card:last-child {
            margin-bottom: 0;
        }

        .section-title {
            margin: 0;
            color: #1e4580;
            font-size: 17px;
            font-weight: 800;
            line-height: 1.5;
        }

        .section-description {
            margin: 9px 0 16px;
            color: #718096;
            font-size: 13px;
            line-height: 1.6;
        }

        .section-actions {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .section-actions .dashboard-link {
            margin: 0;
            padding: 12px 14px;
            background: #ffffff;
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

        /* Logout */

        .logout-area {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
        }

        .logout-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 13px 22px;
            border: 1px solid #fecaca;
            border-radius: 10px;
            background: #ffffff;
            color: #b42335;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }

        .logout-button:hover {
            background: #fff1f2;
            transform: translateY(-1px);
        }

        .logout-button svg {
            width: 18px;
            height: 18px;
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

        @media (max-width: 800px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-container {
                padding: 28px 18px 40px;
            }

            .page-heading h2 {
                font-size: 26px;
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

            .profile-card {
                padding: 22px;
                border-radius: 16px;
            }

            .profile-top {
                gap: 13px;
            }

            .profile-avatar {
                width: 55px;
                height: 55px;
            }

            .profile-top h2 {
                font-size: 20px;
            }

            .profile-details {
                grid-template-columns: 1fr;
            }

            .panel {
                padding: 20px;
            }

            .panel-heading h2 {
                font-size: 18px;
            }

            .logout-area {
                justify-content: stretch;
            }

            .logout-button {
                width: 100%;
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

            .dashboard-container {
                padding-left: 12px;
                padding-right: 12px;
            }

            .profile-card {
                padding: 18px;
            }

            .panel {
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
                <p>Gusau, Zamfara State</p>
            </div>

            <img
                src="{{ asset('images/second-school-logo.jpeg') }}"
                alt="FNPS Gusau Second School Logo"
                class="school-logo"
            >

        </div>
    </header>

    <!-- Dashboard -->

    <main class="dashboard-container">

        <div class="page-heading">
            <h2>Staff Dashboard</h2>
            <p>
                Welcome to your school workspace.
                Manage your assigned classes and access your staff tools.
            </p>
        </div>

        <!-- Success Message -->

        @if (session('success'))
            <div class="message success" role="status">
                {{ session('success') }}
            </div>
        @endif

        <!-- Staff Profile -->

        <section class="profile-card">

            <div class="profile-top">

                <div class="profile-avatar">
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
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </div>

                <div>
                    <h2>Welcome, {{ $user->name }}</h2>
                    <p>Your FNPS Gusau staff account</p>
                </div>

            </div>

            <div class="profile-details">

                <div class="profile-detail">
                    <span>Staff Role</span>
                    <strong>
                        {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                    </strong>
                </div>

                <div class="profile-detail">
                    <span>Email Address</span>
                    <strong>{{ $user->email }}</strong>
                </div>

            </div>

        </section>

        <!-- Dashboard Sections -->

        <div class="dashboard-grid">

            <!-- Administration -->

            @if ($user->role === 'super_admin')

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
                                <path d="M12 3 3 8v2h18V8l-9-5Z"/>
                                <path d="M5 10v8"/>
                                <path d="M9 10v8"/>
                                <path d="M15 10v8"/>
                                <path d="M19 10v8"/>
                                <path d="M3 20h18"/>
                            </svg>
                        </div>

                        <div>
                            <h2>Administration</h2>
                            <p>Manage school operations</p>
                        </div>

                    </div>

                    
                    <!-- Manage Academic Session -->

                    <a
                        href="/academic-sessions"
                        class="dashboard-link"
                    >
                        <span>Manage Academic Session</span>
                        <span class="link-arrow" aria-hidden="true">›</span>
                    </a>

                    <!-- Single Promotion & Transfer -->

                    <a
                        href="/pupil-progression"
                        class="dashboard-link"
                    >
                        <span>Single Promotion &amp; Transfer</span>
                        <span class="link-arrow" aria-hidden="true">›</span>
                    </a>

                    <!-- Batch Promotion & Transfer -->

                    <a
                        href="/batch-pupil-progression"
                        class="dashboard-link"
                    >
                        <span>Batch Promotion &amp; Transfer</span>
                        <span class="link-arrow" aria-hidden="true">›</span>
                    </a>

                    <!-- Register & Manage Pupils -->

                    <a
                        href="/students"
                        class="dashboard-link"
                    >
                        <span>Register &amp; Manage Pupils</span>
                        <span class="link-arrow" aria-hidden="true">›</span>
                    </a>

                    <!-- Single Result Publication -->

                    <a
                        href="/staff/results"
                        class="dashboard-link"
                    >
                        <span>Single Result Publication</span>
                        <span class="link-arrow" aria-hidden="true">›</span>
                    </a>

                    <!-- Staff Management -->

                    <a
                        href="/staff-management"
                        class="dashboard-link"
                    >
                        <span>Staff Management</span>
                        <span class="link-arrow" aria-hidden="true">›</span>
                    </a>


                </section>

            @endif

            <!-- Assigned Classes / Sections -->

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
                        <h2>
                            @if ($user->role === 'teacher')
                                My Assigned Classes
                            @else
                                My Assigned Sections
                            @endif
                        </h2>

                        <p>
                            Your teaching and section assignments
                        </p>
                    </div>

                </div>

                @forelse ($assignedSections as $section)

                    <div class="section-card">

                        <h3 class="section-title">
                            {{ $section->classLevel->name }}
                            — {{ $section->name }}
                        </h3>

                        <p class="section-description">
                            You are assigned to this section.
                            Use the links below to manage scores and view results.
                        </p>

                        <div class="section-actions">

                            <a
                                href="{{ route('results.entry') }}"
                                class="dashboard-link"
                            >
                                <span>Enter and Manage Scores</span>
                                <span class="link-arrow" aria-hidden="true">›</span>
                            </a>

                            <a
                                href="{{ route('results.classes') }}"
                                class="dashboard-link"
                            >
                                <span>View Pupil Results and Download PDFs</span>
                                <span class="link-arrow" aria-hidden="true">›</span>
                            </a>

                        </div>

                    </div>

                @empty

                    <div class="empty-state">

                        <h3>No Assigned Sections Yet</h3>

                        <p>
                            No sections have been assigned to your account yet.
                            Please contact the Super Admin for assistance.
                        </p>

                    </div>

                @endforelse

            </section>

        </div>

        <!-- Logout -->

        <div class="logout-area">

            <form method="POST" action="{{ route('staff.logout') }}">
                @csrf

                <button type="submit" class="logout-button">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <path d="M16 17l5-5-5-5"/>
                        <path d="M21 12H9"/>
                    </svg>

                    Log Out

                </button>

            </form>

        </div>

    </main>

    <!-- Footer -->

    <footer class="footer">
        &copy; {{ date('Y') }}
        <strong>Fatima Nursery and Primary School, Gusau</strong>.
        All rights reserved.
    </footer>

</body>
</html>
