<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Parent Login | FNPS Gusau</title>

    <style>
        /* =========================================
           FNPS GUSAU PARENT / PUPIL LOGIN
           Matching the Staff Login design
        ========================================= */

        :root {
            --primary: #1d4ed8;
            --primary-dark: #123f91;
            --primary-light: #eaf3ff;

            --text: #17345f;
            --muted: #718096;

            --border: #e4ecf8;
            --white: #ffffff;

            --danger: #b42335;
            --danger-bg: #fff1f2;

            --success: #166534;
            --success-bg: #ecfdf3;

            --shadow:
                0 20px 55px rgba(0, 30, 80, 0.25);
        }

        /* =========================================
           GLOBAL
        ========================================= */

        * {
            box-sizing: border-box;
        }

        html {
            min-height: 100%;
        }

        body {
            margin: 0;
            min-height: 100vh;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            color: var(--text);

            background:
                linear-gradient(
                    135deg,
                    #eaf2ff,
                    #f5f8ff,
                    #dce9ff
                );

            display: flex;
            flex-direction: column;
        }

        button,
        input {
            font-family: inherit;
        }

        button {
            -webkit-tap-highlight-color: transparent;
        }

        /* =========================================
           SCHOOL HEADER
        ========================================= */

        .school-header {
            width: 100%;

            padding: 22px 35px;

            background: var(--white);

            box-shadow:
                0 3px 15px rgba(20, 55, 110, 0.08);

            position: relative;
            z-index: 2;
        }

        .header-content {
            width: 100%;
            max-width: 1100px;

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
            min-width: 0;

            text-align: center;
        }

        .school-title h1 {
            margin: 0;

            color: #123f83;

            font-size: 27px;
            font-weight: 800;

            line-height: 1.35;

            letter-spacing: 0.5px;
        }

        .school-title p {
            margin: 7px 0 0;

            color: #64748b;

            font-size: 13px;

            letter-spacing: 1.5px;

            text-transform: uppercase;
        }

        .school-tagline {
            display: inline-block;

            margin-top: 10px;

            padding: 6px 13px;

            border-radius: 30px;

            background: #eaf3ff;

            color: #104da3;

            font-size: 11px;
            font-weight: 800;

            letter-spacing: 0.6px;
        }

        /* =========================================
           MAIN LOGIN AREA
        ========================================= */

        .main-content {
            position: relative;
            isolation: isolate;

            flex: 1;

            width: 100%;

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 45px 20px;

            overflow: hidden;

            /* School photograph with blue overlay */

            background:
                linear-gradient(
                    135deg,
                    rgba(12, 55, 125, 0.78),
                    rgba(23, 105, 210, 0.58)
                ),
                url("{{ asset('images/school_vicinity.jpeg') }}");

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* =========================================
           LOGIN CARD
        ========================================= */

        .login-card {
            position: relative;
            z-index: 1;

            width: 100%;
            max-width: 440px;

            margin: 0 auto;

            padding: 38px;

            background: rgba(255, 255, 255, 0.97);

            border: 1px solid rgba(255, 255, 255, 0.85);

            border-radius: 22px;

            box-shadow: var(--shadow);
        }

        /* =========================================
           LOGIN ICON
        ========================================= */

        .login-icon {
            width: 72px;
            height: 72px;

            margin: 0 auto 18px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #e8f0ff;

            border-radius: 50%;

            color: #1d4ed8;
        }

        .login-icon svg {
            width: 36px;
            height: 36px;
        }

        /* =========================================
           LOGIN HEADING
        ========================================= */

        .login-card h2 {
            text-align: center;

            margin: 0;

            color: #173f7a;

            font-size: 27px;
            font-weight: 800;

            line-height: 1.35;
        }

        .login-subtitle {
            text-align: center;

            color: #718096;

            font-size: 14px;

            line-height: 1.6;

            margin: 10px 0 28px;
        }

        /* =========================================
           SUCCESS AND ERROR MESSAGES
        ========================================= */

        .message {
            padding: 13px 15px;

            border-radius: 10px;

            margin-bottom: 20px;

            font-size: 14px;

            line-height: 1.6;
        }

        .message.success {
            color: var(--success);

            background: var(--success-bg);

            border: 1px solid #bbf7d0;
        }

        .message.error {
            color: var(--danger);

            background: var(--danger-bg);

            border: 1px solid #fecdd3;
        }

        .message.error strong {
            display: block;

            margin-bottom: 7px;
        }

        .message.error p {
            margin: 4px 0;
        }

        /* =========================================
           FORM
        ========================================= */

        .form-group {
            margin-bottom: 21px;
        }

        .form-group label {
            display: block;

            margin-bottom: 9px;

            color: #243b60;

            font-size: 14px;
            font-weight: 700;
        }

        .input-wrapper {
            position: relative;
            width: 100%;
        }

        .form-input {
            display: block;

            width: 100%;
            min-height: 50px;

            padding: 14px 15px;

            border: 1px solid #d6e0ef;

            border-radius: 10px;

            background: #f9fbff;

            color: #17345f;

            font-size: 15px;

            outline: none;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .form-input::placeholder {
            color: #9aa9bd;
        }

        .form-input:focus {
            border-color: #2563eb;

            background: #ffffff;

            box-shadow:
                0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        /* =========================================
           ADMISSION NUMBER
        ========================================= */

        .admission-input {
            padding-right: 15px;
        }

        /* =========================================
           PIN INPUT
        ========================================= */

        .pin-input {
            padding-right: 90px;
        }

        .toggle-pin {
            position: absolute;

            top: 50%;
            right: 10px;

            transform: translateY(-50%);

            width: auto;
            min-height: auto;

            margin: 0;

            padding: 7px 10px;

            border: none;

            border-radius: 7px;

            background: #eaf3ff;

            color: #104da3;

            font-size: 12px;
            font-weight: 800;

            cursor: pointer;

            transition:
                background 0.2s ease,
                color 0.2s ease;
        }

        .toggle-pin:hover {
            background: #d7e8ff;

            color: #123f91;
        }

        .toggle-pin:focus-visible {
            outline: 3px solid #93c5fd;

            outline-offset: 3px;
        }

        /* =========================================
           INPUT HINTS
        ========================================= */

        .input-hint {
            display: block;

            margin-top: 7px;

            color: #718096;

            font-size: 12px;

            line-height: 1.5;
        }

        /* =========================================
           SIGN IN BUTTON
        ========================================= */

        .login-button {
            display: flex;
            align-items: center;
            justify-content: center;

            gap: 10px;

            width: 100%;
            min-height: 52px;

            margin-top: 8px;

            padding: 15px 20px;

            border: none;

            border-radius: 10px;

            background:
                linear-gradient(
                    135deg,
                    #1d4ed8,
                    #123f91
                );

            color: #ffffff;

            font-size: 15px;
            font-weight: 800;

            cursor: pointer;

            box-shadow:
                0 6px 16px rgba(29, 78, 216, 0.22);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .login-button:hover {
            background:
                linear-gradient(
                    135deg,
                    #1e40af,
                    #123575
                );

            transform: translateY(-2px);

            box-shadow:
                0 9px 22px rgba(29, 78, 216, 0.30);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .login-button:focus-visible {
            outline: 3px solid #93c5fd;

            outline-offset: 3px;
        }

        .login-button:disabled {
            opacity: 0.7;

            cursor: not-allowed;

            transform: none;
        }

        /* =========================================
           SECURITY NOTICE
        ========================================= */

        .security-note {
            margin-top: 22px;

            padding: 17px 14px;

            border-top: 1px solid #edf2f8;

            text-align: center;

            color: #7b8ba3;

            font-size: 12px;

            line-height: 1.7;
        }

        .security-note strong {
            color: #526784;

            font-size: 12px;
        }

        /* =========================================
           FOOTER
        ========================================= */

        .footer {
            width: 100%;

            padding: 18px 15px;

            text-align: center;

            color: #718096;

            font-size: 12px;

            line-height: 1.7;

            background: #ffffff;
        }

        .footer strong {
            color: #31558a;
        }

        /* =========================================
           TABLET AND MOBILE
        ========================================= */

        @media (max-width: 600px) {

            .school-header {
                padding: 17px 14px;
            }

            .header-content {
                gap: 10px;
            }

            .school-logo {
                width: 65px;
                height: 65px;
            }

            .school-title h1 {
                font-size: 18px;

                line-height: 1.4;
            }

            .school-title p {
                font-size: 10px;

                letter-spacing: 0.7px;
            }

            .school-tagline {
                margin-top: 7px;

                padding: 5px 9px;

                font-size: 9px;

                letter-spacing: 0.3px;
            }

            .main-content {
                padding: 30px 15px;

                background-position: center;
            }

            .login-card {
                max-width: 440px;

                padding: 28px 22px;

                border-radius: 18px;
            }

            .login-icon {
                width: 65px;
                height: 65px;
            }

            .login-card h2 {
                font-size: 24px;
            }

            .login-subtitle {
                font-size: 13px;

                margin-bottom: 24px;
            }

            .footer {
                padding: 16px 12px;
            }
        }

        /* =========================================
           SMALL MOBILE
        ========================================= */

        @media (max-width: 360px) {

            .school-header {
                padding: 14px 9px;
            }

            .header-content {
                gap: 6px;
            }

            .school-logo {
                width: 48px;
                height: 48px;
            }

            .school-title h1 {
                font-size: 15px;
            }

            .school-title p {
                font-size: 9px;

                letter-spacing: 0.3px;
            }

            .school-tagline {
                font-size: 8px;

                padding: 4px 7px;
            }

            .main-content {
                padding: 24px 10px;
            }

            .login-card {
                padding: 25px 17px;

                border-radius: 16px;
            }

            .login-icon {
                width: 58px;
                height: 58px;

                margin-bottom: 15px;
            }

            .login-card h2 {
                font-size: 22px;
            }

            .login-subtitle {
                font-size: 12px;
            }

            .form-input {
                font-size: 16px;
            }

            .login-button {
                min-height: 50px;

                font-size: 14px;
            }
        }

        /* =========================================
           ACCESSIBILITY
        ========================================= */

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                transition: none !important;
                animation: none !important;
                scroll-behavior: auto !important;
            }
        }

    </style>
</head>

<body>

    <!-- =========================================
         SCHOOL HEADER
    ========================================= -->

    <header class="school-header">

        <div class="header-content">

            <!-- First School Logo -->

            <img
                src="{{ asset('images/school-logo.jpeg') }}"
                alt="Fatima Nursery and Primary School Logo"
                class="school-logo"
            >

            <!-- School Name -->

            <div class="school-title">

                <h1>
                    Fatima Nursery and Primary School
                </h1>

                <p>
                    Gusau, Zamfara State
                </p>

                <span class="school-tagline">
                    PARENT / PUPIL PORTAL
                </span>

            </div>

            <!-- Second School Logo -->

            <img
                src="{{ asset('images/second-school-logo.jpeg') }}"
                alt="Fatima Nursery and Primary School Second Logo"
                class="school-logo"
            >

        </div>

    </header>


    <!-- =========================================
         MAIN LOGIN AREA
    ========================================= -->

    <main class="main-content">

        <!-- =====================================
             LOGIN CARD
        ===================================== -->

        <section class="login-card">

            <!-- Login Icon -->

            <div class="login-icon" aria-hidden="true">

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

                    <rect
                        x="3"
                        y="11"
                        width="18"
                        height="10"
                        rx="2"
                    />

                    <path
                        d="M7 11V7a5 5 0 0 1 10 0v4"
                    />

                    <circle
                        cx="12"
                        cy="16"
                        r="1"
                    />

                </svg>

            </div>


            <!-- Login Heading -->

            <h2>
                Welcome Back
            </h2>

            <p class="login-subtitle">

                Sign in to access your child's information
                and academic results.

            </p>


            <!-- =================================
                 SUCCESS MESSAGE
            ================================= -->

            @if (session('success'))

                <div
                    class="message success"
                    role="status"
                >

                    {{ session('success') }}

                </div>

            @endif


            <!-- =================================
                 VALIDATION ERRORS
            ================================= -->

            @if ($errors->any())

                <div
                    class="message error"
                    role="alert"
                >

                    <strong>
                        Please check the following:
                    </strong>

                    @foreach ($errors->all() as $error)

                        <p>
                            {{ $error }}
                        </p>

                    @endforeach

                </div>

            @endif


            <!-- =================================
                 PARENT / PUPIL LOGIN FORM
            ================================= -->

            <form
                method="POST"
                action="{{ route('parent.login.submit') }}"
            >

                @csrf


                <!-- =================================
                     ADMISSION NUMBER
                ================================= -->

                <div class="form-group">

                    <label for="login_id">

                        Admission Number

                    </label>

                    <input
                        id="login_id"
                        class="form-input admission-input"
                        name="login_id"
                        type="text"
                        value="{{ old('login_id') }}"
                        maxlength="100"
                        autocomplete="username"
                        placeholder="Enter your admission number"
                        required
                        autofocus
                    >

                    <span class="input-hint">

                        Enter the admission number provided by the school.

                    </span>

                </div>


                <!-- =================================
                     FOUR-DIGIT PIN
                ================================= -->

                <div class="form-group">

                    <label for="pin">

                        Four-digit PIN

                    </label>

                    <div class="input-wrapper">

                        <input
                            id="pin"
                            class="form-input pin-input"
                            name="pin"
                            type="password"
                            inputmode="numeric"
                            pattern="[0-9]{4}"
                            minlength="4"
                            maxlength="4"
                            autocomplete="current-password"
                            placeholder="Enter your four-digit PIN"
                            required
                        >

                        <!-- Show / Hide PIN -->

                        <button
                            type="button"
                            class="toggle-pin"
                            id="toggle-pin"
                            aria-controls="pin"
                            aria-pressed="false"
                        >

                            Show PIN

                        </button>

                    </div>

                    <span class="input-hint">

                        Your PIN must contain exactly four digits.

                    </span>

                </div>


                <!-- =================================
                     SIGN IN BUTTON
                ================================= -->

                <button
                    type="submit"
                    class="login-button"
                >

                    <span aria-hidden="true">
                        🔒
                    </span>

                    Sign In

                </button>


            </form>


            <!-- =================================
                 SECURITY NOTICE
            ================================= -->

            <div class="security-note">

                <strong>
                    Secure Parent / Pupil Access
                </strong>

                <br>

                Your login details are private.

                Please do not share your admission number
                or PIN with anyone.

            </div>


        </section>

    </main>


    <!-- =========================================
         FOOTER
    ========================================= -->

    <footer class="footer">

        &copy; {{ date('Y') }}

        <strong>
            Fatima Nursery and Primary School Gusau
        </strong>

        . All rights reserved.

        <br>

        Parent / Pupil Portal

    </footer>


    <!-- =========================================
         SHOW / HIDE PIN
    ========================================= -->

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const pinInput =
                document.getElementById('pin');

            const toggleButton =
                document.getElementById('toggle-pin');


            if (!pinInput || !toggleButton) {
                return;
            }


            toggleButton.addEventListener('click', function () {

                const isPinHidden =
                    pinInput.type === 'password';


                // Show or hide the PIN

                pinInput.type = isPinHidden
                    ? 'text'
                    : 'password';


                // Update button text

                toggleButton.textContent = isPinHidden
                    ? 'Hide PIN'
                    : 'Show PIN';


                // Update accessibility state

                toggleButton.setAttribute(
                    'aria-pressed',
                    isPinHidden ? 'true' : 'false'
                );


            });

        });

    </script>

</body>
</html>
