<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change PIN | FNPS Gusau</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 420px; margin: 50px auto; padding: 20px; color: #263346; }
        label { display: block; margin-top: 16px; font-weight: bold; }
        input { width: 100%; box-sizing: border-box; padding: 12px; margin-top: 6px; }
        button { margin-top: 20px; padding: 12px; width: 100%; }
        .error { color: #a21d1d; }
    </style>
</head>
<body>
    <h1>Change Your PIN</h1>
    <p>For your security, create a new PIN before continuing to the portal.</p>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('parent.pin.update') }}">
        @csrf

        <label for="current_pin">Temporary / Current PIN</label>
        <input id="current_pin" name="current_pin" type="password"
               inputmode="numeric" pattern="[0-9]{4}" minlength="4" maxlength="4"
               autocomplete="current-password" required>

        <label for="pin">New four-digit PIN</label>
        <input id="pin" name="pin" type="password" inputmode="numeric"
               pattern="[0-9]{4}" minlength="4" maxlength="4"
               autocomplete="new-password" required>

        <label for="pin_confirmation">Confirm new PIN</label>
        <input id="pin_confirmation" name="pin_confirmation" type="password"
               inputmode="numeric" pattern="[0-9]{4}" minlength="4" maxlength="4"
               autocomplete="new-password" required>

        <button type="submit">Change PIN</button>
    </form>

    <form method="POST" action="{{ route('parent.logout') }}">
        @csrf
        <button type="submit">Sign Out</button>
    </form>
</body>
</html>

