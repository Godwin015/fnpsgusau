<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Staff Password | FNPS Gusau</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 480px;
            margin: 45px auto;
            padding: 20px;
        }
        label { display: block; margin-top: 18px; }
        input {
            box-sizing: border-box;
            width: 100%;
            padding: 11px;
            margin-top: 6px;
        }
        button { margin-top: 22px; padding: 12px; cursor: pointer; }
        .error { color: #b00020; }
    </style>
</head>
<body>
    <h1>FNPS Gusau</h1>
    <h2>Change Your Password</h2>

    <p>
        For security, you must replace your temporary password before
        accessing staff pages.
    </p>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('staff.password.update') }}">
        @csrf

        <label for="current_password">Temporary/current password</label>
        <input
            id="current_password"
            type="password"
            name="current_password"
            autocomplete="current-password"
            required
        >

        <label for="password">New password (at least 12 characters)</label>
        <input
            id="password"
            type="password"
            name="password"
            autocomplete="new-password"
            minlength="12"
            required
        >

        <label for="password_confirmation">Confirm new password</label>
        <input
            id="password_confirmation"
            type="password"
            name="password_confirmation"
            autocomplete="new-password"
            minlength="12"
            required
        >

        <button type="submit">Change Password</button>
    </form>

    <form method="POST" action="{{ route('staff.logout') }}">
        @csrf
        <button type="submit">Log out</button>
    </form>
</body>
</html>

