@extends('layouts.app')

@section('title', __('site.nav.dashboard'))

@section('content')
    <section class="page-hero">
        <p class="kicker">{{ __('site.dashboard.title') }}</p>
        <h1>{{ __('site.dashboard.welcome', ['name' => $user->name]) }}</h1>
        <p>{{ __('site.dashboard.text') }}</p>
    </section>

    <section class="section">
        <div class="dash-grid">
            <a class="card glow-card dash-card" href="{{ route('artists.index') }}">
                <p class="kicker">02</p>
                <h2>{{ __('site.dashboard.artists') }}</h2>
            </a>
            <a class="card glow-card dash-card" href="{{ route('music.index') }}">
                <p class="kicker">03</p>
                <h2>{{ __('site.dashboard.music') }}</h2>
            </a>
            <a class="card glow-card dash-card" href="{{ route('auditions.index') }}">
                <p class="kicker">05</p>
                <h2>{{ __('site.dashboard.auditions') }}</h2>
            </a>
            <a class="card glow-card dash-card" href="{{ route('news.index') }}">
                <p class="kicker">07</p>
                <h2>{{ __('site.dashboard.news') }}</h2>
            </a>
        </div>

        <article class="card glow-card account-card">
            <p class="kicker">{{ __('site.dashboard.account') }}</p>
            <h2>{{ __('site.dashboard.signed_in') }}</h2>
            <p><strong>{{ $user->name }}</strong></p>
            <p class="meta">{{ $user->email }}</p>
            <form method="POST" action="{{ route('logout') }}" class="actions">
                @csrf
                <button class="btn btn-line" type="submit">{{ __('site.nav.logout') }}</button>
            </form>
        </article>
    </section>
@endsection
