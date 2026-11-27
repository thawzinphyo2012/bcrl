<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Admin login · BCRL</title>
    <meta name="robots" content="noindex">
    <link rel="icon" href="{{ asset('images/bcrl-logo.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fahkwang:wght@500;600&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">
    <main class="admin-login">
        <div class="admin-login-card">
            @include('partials.brand', [
                'size' => 56,
                'subtitle' => 'Admin',
                'markClass' => 'mark-login',
            ])
            <h1>Sign in</h1>
            <p>Manage groups, songs, news, auditions, and partnership notes.</p>
            <form method="POST" action="{{ route('admin.login.store') }}" class="admin-form">
                @csrf
                <label class="admin-field">
                    <span>Email</span>
                    <input type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                    @error('email') <em>{{ $message }}</em> @enderror
                </label>
                <label class="admin-field">
                    <span>Password</span>
                    <input type="password" name="password" required autocomplete="current-password">
                </label>
                <label class="admin-check">
                    <input type="checkbox" name="remember" value="1">
                    <span>Keep me signed in</span>
                </label>
                <button class="admin-btn admin-btn-gold" type="submit">Enter admin</button>
            </form>
        </div>
    </main>
</body>
</html>
