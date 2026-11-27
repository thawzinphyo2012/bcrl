@extends('layouts.app')

@section('title', __('site.nav.account'))

@section('content')
    <section class="page-hero">
        <p class="kicker">08 — Account</p>
        <h1>{{ __('site.auth.account_title') }}</h1>
        <p>{{ __('site.auth.account_text') }}</p>
    </section>

    <section class="section auth-section auth-combo">
        <form class="form auth-card glow-card" method="POST" action="{{ route('login.store') }}" id="login">
            @csrf
            <p class="kicker">{{ __('site.nav.login') }}</p>
            <h2>{{ __('site.auth.login_title') }}</h2>
            <p>{{ __('site.auth.login_text') }}</p>
            <label class="field">
                <span>{{ __('site.auth.email') }}</span>
                <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
            </label>
            <label class="field">
                <span>{{ __('site.auth.password') }}</span>
                <input type="password" name="password" required autocomplete="current-password">
            </label>
            <label class="check">
                <input type="checkbox" name="remember" value="1">
                <span>{{ __('site.auth.remember') }}</span>
            </label>
            @if ($errors->any() && old('name') === null)
                <p class="field-error">{{ $errors->first() }}</p>
            @endif
            <button class="btn btn-gold" type="submit">{{ __('site.auth.login_btn') }}</button>
        </form>

        <form class="form auth-card glow-card" method="POST" action="{{ route('register.store') }}" id="register">
            @csrf
            <p class="kicker">{{ __('site.nav.register') }}</p>
            <h2>{{ __('site.auth.register_title') }}</h2>
            <p>{{ __('site.auth.register_text') }}</p>
            <label class="field">
                <span>{{ __('site.auth.name') }}</span>
                <input type="text" name="name" value="{{ old('name') }}" required maxlength="80" autocomplete="name">
            </label>
            <label class="field">
                <span>{{ __('site.auth.email') }}</span>
                <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
            </label>
            <label class="field">
                <span>{{ __('site.auth.password') }}</span>
                <input type="password" name="password" required autocomplete="new-password">
            </label>
            <label class="field">
                <span>{{ __('site.auth.password_confirm') }}</span>
                <input type="password" name="password_confirmation" required autocomplete="new-password">
            </label>
            @if ($errors->any() && old('name') !== null)
                <p class="field-error">{{ $errors->first() }}</p>
            @endif
            <button class="btn btn-gold" type="submit">{{ __('site.auth.register_btn') }}</button>
        </form>
    </section>
@endsection
