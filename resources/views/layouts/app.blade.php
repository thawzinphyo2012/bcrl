<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>@yield('title', 'Home') · BCRL</title>
    <meta name="description" content="@yield('description', 'Big Cheese Record Label is a Myanmar-born music and artist development label. Create with Passion. Big Potential with Big Cheese.')">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Home') · Big Cheese Record Label">
    <meta property="og:description" content="@yield('description', 'Create with Passion. Big Potential with Big Cheese.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="icon" href="{{ asset('images/bcrl-logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/bcrl-logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@500;600;700;800&family=Manrope:wght@400;500;600;700&family=Noto+Sans+Myanmar:wght@400;600;700&family=Noto+Sans+SC:wght@400;600;700&display=swap" rel="stylesheet">
    <script>
        (function () {
            try {
                var theme = localStorage.getItem('bcrl-theme');
                if (theme === 'light' || theme === 'dark') {
                    document.documentElement.setAttribute('data-theme', theme);
                } else {
                    document.documentElement.setAttribute('data-theme', 'dark');
                }
            } catch (e) {
                document.documentElement.setAttribute('data-theme', 'dark');
            }
        })();
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <a class="skip" href="#content">{{ __('site.skip') }}</a>
    <div class="shell">
        @include('partials.header')
        @if (session('status'))
            <div class="flash" role="status">{{ session('status') }}</div>
        @endif
        <main id="content">
            @yield('content')
        </main>
        @unless (request()->routeIs('studio.*') || request()->routeIs('dashboard') || request()->routeIs('login') || request()->routeIs('register'))
        <div class="ticker" aria-hidden="true">
            <div class="ticker-track">
                <span>{{ config('bcrl.motto') }}</span>
                <span>Big Cheese Record Label</span>
                <span>Create with Passion</span>
                <span>Big Potential with Big Cheese</span>
                <span>{{ config('bcrl.motto') }}</span>
                <span>Big Cheese Record Label</span>
                <span>Create with Passion</span>
                <span>Big Potential with Big Cheese</span>
            </div>
        </div>
        @endunless
        @include('partials.footer')
    </div>
    <a class="to-top" href="#content" aria-label="{{ __('site.back_top') }}">↑</a>
</body>
</html>
