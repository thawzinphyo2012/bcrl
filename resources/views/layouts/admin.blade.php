<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>@yield('title', 'Dashboard') · Admin · BCRL</title>
    <meta name="robots" content="noindex">
    <link rel="icon" href="{{ asset('images/bcrl-logo.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fahkwang:wght@500;600&family=Manrope:wght@400;500;600;700&family=Noto+Sans+Myanmar:wght@400;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">
    <div class="admin-shell">
        @include('admin.partials.sidebar')
        <div class="admin-main">
            <header class="admin-top">
                <div>
                    <p class="admin-kicker">@yield('kicker', 'Admin')</p>
                    <h1>@yield('heading', 'Dashboard')</h1>
                </div>
                <div class="admin-top-actions">
                    <a class="admin-btn admin-btn-line" href="{{ route('home') }}" target="_blank" rel="noopener">View site</a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="admin-btn admin-btn-line" type="submit">Log out</button>
                    </form>
                </div>
            </header>
            @include('admin.partials.mobile-nav')

            @if (session('status'))
                <div class="admin-flash" role="status">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="admin-flash admin-flash-error" role="alert">
                    Please check the form and try again.
                </div>
            @endif

            <div class="admin-content">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
