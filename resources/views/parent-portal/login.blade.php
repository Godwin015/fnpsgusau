<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Parent Login | FNPS Gusau</title>

    <style>
        :root {
            --primary: #1769d2;
            --primary-dark: #104da3;
            --primary-light: #eaf3ff;
            --text: #1e293b;
            --muted: #64748b;
            --border: #dce6f2;
            --white: #ffffff;
            --danger: #b91c1c;
            --danger-bg: #fee2e2;
            --shadow: 0 12px 35px rgba(23, 105, 210, 0.10);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            min-height: 100vh;
            padding: 30px 16px;
            color: var(--text);
            background: linear-gradient(
                180deg,
                #eaf3ff 0,
                #f5f9ff 350px,
                #f7f9fc 100%
            );
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .page-container {
            width: 100%;
            max-width: 650px;
            margin: auto;
        }

        /* SCHOOL HEADER */

        .school-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 20px;
            margin-bottom: 25px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: var(--shadow);
        }

        .school-logo,
        .school-logo-right {
            width: 100px;
            height: 100px;
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
            font-size: 23px;
            line-height: 1.35;
            font-weight: 800;
            margin: 0;
        }

        .school-header-center p {
            color: var(--muted);
            font-size: 14px;
            margin: 7px 0 0;
        }

        .school-tagline {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 12px;
            border-radius: 30px;
            background: var(--primary-light);
            color: var(--primary-dark);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        /* LOGIN CARD */

        .login-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 32px;
            box-shadow: var(--shadow);
        }

        .login-heading {
            text-align: center;
            margin-bottom: 28px;
        }

        .login-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 65px;
            height: 65px;
            margin: 0 auto 15px;
            border-radius: 18px;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 30px;
        }

        .login-heading h2 {
            color: var(--primary-dark);
            font-size: 25px;
            margin: 0;
        }

        .login-heading p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
            margin: 10px 0 0;
        }

        /* ERROR MESSAGE */

        .error {
            padding: 14px 16px;
            margin-bottom: 22px;
            color: var(--danger);
            background: var(--danger-bg);
            border: 1px solid #fecaca;
            border-radius: 12px;
            font-size: 14px;
        }

        .error p {
            margin: 0;
            line-height: 1.6;
        }

        .error p + p {
            margin-top: 8px;
        }

        /* FORM */

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
        }

        input {
            display: block;
            width: 100%;
            min-height: 50px;
            padding: 13px 15px;
            border: 1px solid #cbd8e8;
            border-radius: 11px;
            background: #ffffff;
            color: var(--text);
            font-family: inherit;
            font-size: 16px;
            outline: none;
            transition: border-color 0.2s ease,
                        box-shadow 0.2s ease;
        }

        input::placeholder {
            color: #94a3b8;
        }

        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(23, 105, 210, 0.12);
        }

        .input-hint {
            display: block;
            margin-top: 7px;
            color: var(--muted);
            font-size: 12px;
        }

        /* PIN FIELD */

        .pin-wrapper {
            position: relative;
        }

        .pin-wrapper input {
            padding-right: 85px;
        }

        .toggle-pin {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            min-height: auto;
            width: auto;
            margin: 0;
            padding: 8px 10px;
            border: none;
            border-radius: 7px;
            background: var(--primary-light);
            color: var(--primary-dark);
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .toggle-pin:hover {
            background: #d7e8ff;
        }

        /* SIGN IN BUTTON */

        .signin-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            min-height: 52px;
            margin-top: 8px;
            padding: 14px 20px;
            border: none;
            border-radius: 11px;
            background: var(--primary);
            color: #ffffff;
            font-family: inherit;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 5px 12px rgba(23, 105, 210, 0.18);
            transition: background 0.2s ease,
                        transform 0.2s ease,
                        box-shadow 0.2s ease;
        }

        .signin-button:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 7px 16px rgba(23, 105, 210, 0.22);
        }

        .signin-button:active {
            transform: translateY(0);
        }

        .signin-button:focus-visible,
        .toggle-pin:focus-visible {
            outline: 3px solid #93c5fd;
            outline-offset: 3px;
        }

        /* SECURITY NOTE */

        .security-note {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 22px;
            padding: 14px;
            border: 1px solid #dbeafe;
            border-radius: 11px;
            background: #f3f8ff;
        }

        .security-icon {
            flex-shrink: 0;
            font-size: 18px;
        }

        .security-note p {
            margin: 0;
            color: #475569;
            font-size: 12px;
            line-height: 1.6;
        }

        /* FOOTER */

        .footer {
            text-align: center;
            padding: 22px 10px 5px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        /* TABLET */

        @media (max-width: 600px) {
            body {
                padding: 20px 12px;
            }

            .school-header {
                gap: 10px;
                padding: 16px 12px;
                border-radius: 15px;
            }

            .school-logo,
            .school-logo-right {
                width: 75px;
                height: 75px;
            }

            .school-header-center h1 {
                font-size: 19px;
            }

            .school-header-center p {
                font-size: 12px;
            }

            .login-card {
                padding: 25px 20px;
                border-radius: 16px;
            }

            .login-heading h2 {
                font-size: 23px;
            }
        }

        /* MOBILE */

        @media (max-width: 400px) {
            body {
                padding: 14px 10px;
            }

            .school-header {
                gap: 6px;
                padding: 13px 7px;
                margin-bottom: 18px;
            }

            .school-logo,
            .school-logo-right {
                width: 52px;
                height: 52px;
            }

            .school-header-center h1 {
                font-size: 15px;
                line-height: 1.4;
            }

            .school-header-center p {
                font-size: 10px;
                margin-top: 4px;
            }

            .school-tagline {
                font-size: 9px;
                padding: 4px 8px;
                margin-top: 6px;
            }

            .login-card {
                padding: 22px 15px;
            }

            .login-icon {
                width: 55px;
                height: 55px;
                font-size: 25px;
                border-radius: 15px;
            }

            .login-heading h2 {
                font-size: 21px;
            }

            .login-heading p {
                font-size: 13px;
            }

            input {
                font-size: 16px;
            }

            .signin-button {
                min-height: 50px;
            }
        }

        @media (max-width: 320px) {
            .school-logo,
            .school-logo-right {
                width: 42px;
                height: 42px;
            }

            .school-header-center h1 {
                font-size: 13px;
            }

            .school-header-center p {
                font-size: 9px;
            }

            .school-tagline {
                display: none;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                transition: none !important;
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
                PARENT / PUPIL PORTAL
            </span>

        </div>

        <img
            src="{{ asset('images/second-school-logo.jpeg') }}"
            alt="School Second Logo"
            class="school-logo-right"
        >

    </div>

    <!-- LOGIN CARD -->

    <div class="login-card">

        <div class="login-heading">

            <div class="login-icon" aria-hidden="true">
                🔐
            </div>

            <h2>Welcome Back</h2>

            <p>
                Sign in to access your child's information
                and academic results.
            </p>

        </div>

        <!-- VALIDATION ERRORS -->

        @if ($errors->any())

            <div class="error" role="alert">

                @foreach ($errors->all() as $error)

                    <p>{{ $error }}</p>

                @endforeach

            </div>

        @endif

        <!-- LOGIN FORM -->

        <form
            method="POST"
            action="{{ route('parent.login.submit') }}"
        >

            @csrf

            <!-- ADMISSION NUMBER -->

            <div class="form-group">

                <label for="login_id">
                    Admission Number
                </label>

                <input
                    id="login_id"
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

            <!-- FOUR-DIGIT PIN -->

            <div class="form-group">

                <label for="pin">
                    Four-digit PIN
                </label>

                <div class="pin-wrapper">

                    <input
                        id="pin"
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

            <!-- SIGN IN -->

            <button
                type="submit"
                class="signin-button"
            >

                <span aria-hidden="true">🔓</span>

                Sign In

            </button>

        </form>

        <!-- SECURITY INFORMATION -->

        <div class="security-note">

            <div class="security-icon" aria-hidden="true">
                🛡️
            </div>

            <p>
                Your login details are private.
                Please do not share your admission number
                or PIN with anyone.
            </p>

        </div>

    </div>

    <!-- FOOTER -->

    <div class="footer">

        Fatima Nursery and Primary School

        <br>

        Gusau, Zamfara State

        <br>

        Parent / Pupil Portal

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const pinInput = document.getElementById('pin');
        const toggleButton = document.getElementById('toggle-pin');

        toggleButton.addEventListener('click', function () {

            const isHidden = pinInput.type === 'password';

            pinInput.type = isHidden ? 'text' : 'password';

            toggleButton.textContent = isHidden
                ? 'Hide PIN'
                : 'Show PIN';

            toggleButton.setAttribute(
                'aria-pressed',
                isHidden ? 'true' : 'false'
            );

        });

    });
</script>

</body>
</html>
