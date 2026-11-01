<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Staff Login | FNPS Gusau</title>

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
            display: flex;
            flex-direction: column;
        }

        /* School Header */

        .school-header {
            width: 100%;
            padding: 22px 35px;
            background: #ffffff;
            box-shadow: 0 3px 15px rgba(20, 55, 110, 0.08);
        }

        .header-content {
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
            text-align: center;
        }

        .school-title h1 {
            margin: 0;
            color: #123f83;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .school-title p {
            margin: 7px 0 0;
            color: #64748b;
            font-size: 13px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        /* Main Login Area */

        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 45px 20px;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            background: #ffffff;
            padding: 38px;
            border-radius: 22px;
            box-shadow: 0 15px 45px rgba(30, 64, 125, 0.14);
            border: 1px solid #e4ecf8;
        }

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

        .login-card h2 {
            text-align: center;
            margin: 0;
            color: #173f7a;
            font-size: 27px;
            font-weight: 800;
        }

        .login-subtitle {
            text-align: center;
            color: #718096;
            font-size: 14px;
            line-height: 1.6;
            margin: 10px 0 28px;
        }

        /* Messages */

        .message {
            padding: 13px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.5;
        }

        .success {
            color: #166534;
            background: #ecfdf3;
            border: 1px solid #bbf7d0;
        }

        .error {
            color: #b42335;
            background: #fff1f2;
            border: 1px solid #fecdd3;
        }

        .error p {
            margin: 4px 0;
        }

        /* Form */

        .form-group {
            margin-bottom: 21px;
        }

        label {
            display: block;
            margin-bottom: 9px;
            color: #243b60;
            font-size: 14px;
            font-weight: 700;
        }

        .input-wrapper {
            position: relative;
        }

        input {
            width: 100%;
            padding: 14px 15px;
            border: 1px solid #d6e0ef;
            border-radius: 10px;
            background: #f9fbff;
            color: #17345f;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus {
            border-color: #2563eb;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        input::placeholder {
            color: #9aa9bd;
        }

        .password-input {
            padding-right: 85px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            width: auto;
            margin: 0;
            padding: 6px 8px;
            border: none;
            background: transparent;
            color: #2563eb;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .toggle-password:hover {
            color: #1e40af;
        }

        /* Login Button */

        .login-button {
            width: 100%;
            padding: 15px;
            margin-top: 8px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #1d4ed8, #123f91);
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 6px 16px rgba(29, 78, 216, 0.22);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 9px 22px rgba(29, 78, 216, 0.30);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .login-button:focus-visible {
            outline: 3px solid #93c5fd;
            outline-offset: 3px;
        }

        .security-note {
            margin-top: 22px;
            padding-top: 17px;
            border-top: 1px solid #edf2f8;
            text-align: center;
            color: #7b8ba3;
            font-size: 12px;
            line-height: 1.6;
        }

        /* Footer */

        .footer {
            padding: 18px 15px;
            text-align: center;
            color: #718096;
            font-size: 12px;
        }

        .footer strong {
            color: #31558a;
        }

        /* Mobile */

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

            .main-content {
                padding: 30px 15px;
            }

            .login-card {
                padding: 28px 22px;
                border-radius: 18px;
            }

            .login-card h2 {
                font-size: 24px;
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

            .login-card {
                padding: 25px 18px;
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

    <!-- Login Section -->

    <main class="main-content">

        <section class="login-card">

            <div class="login-icon">
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

            <h2>Staff Login</h2>

            <p class="login-subtitle">
                Welcome back! Sign in to access the
                FNPS Gusau staff portal.
            </p>

            <!-- Success Message -->

            @if (session('success'))
                <div class="message success" role="status">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Validation Errors -->

            @if ($errors->any())
                <div class="message error" role="alert">
                    <strong>Please check the following:</strong>

                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Login Form -->

            <form
                method="POST"
                action="{{ route('staff.login.submit') }}"
            >
                @csrf

                <div class="form-group">
                    <label for="email">Staff Email</label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your staff email"
                        autocomplete="username"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <div class="input-wrapper">
                        <input
                            id="password"
                            class="password-input"
                            type="password"
                            name="password"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="toggle-password"
                            id="togglePassword"
                            aria-controls="password"
                            aria-pressed="false"
                        >
                            Show
                        </button>
                    </div>
                </div>

                <button type="submit" class="login-button">
                    Sign In to Staff Portal
                </button>

            </form>

            <div class="security-note">
                <strong>Secure Staff Access</strong>
                <br>
                This portal is for authorized Fatima Nursery and Primary School Gusau staff only.
            </div>

        </section>

    </main>

    <!-- Footer -->

    <footer class="footer">
        &copy; {{ date('Y') }}
        <strong>Fatima Nursery and Primary School Gusau</strong>.
        All rights reserved.
    </footer>

    <!-- Show / Hide Password -->

    <script>
        const passwordInput = document.getElementById('password');
        const toggleButton = document.getElementById('togglePassword');

        toggleButton.addEventListener('click', function () {
            const isPasswordHidden =
                passwordInput.type === 'password';

            passwordInput.type = isPasswordHidden
                ? 'text'
                : 'password';

            toggleButton.textContent = isPasswordHidden
                ? 'Hide'
                : 'Show';

            toggleButton.setAttribute(
                'aria-pressed',
                isPasswordHidden ? 'true' : 'false'
            );
        });
    </script>

</body>
</html>
