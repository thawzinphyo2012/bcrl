@extends('layouts.app')

@section('title', __('site.nav.register'))

@section('content')
    <section class="page-hero">
        <p class="kicker">Account</p>
        <h1>{{ __('site.auth.register_title') }}</h1>
        <p>{{ __('site.auth.register_text') }}</p>
    </section>

    <section class="section auth-section">
        <form class="form auth-card glow-card" method="POST" action="{{ route('register.store') }}">
            @csrf
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
            @if ($errors->any())
                <p class="field-error">{{ $errors->first() }}</p>
            @endif
            <button class="btn btn-gold" type="submit">{{ __('site.auth.register_btn') }}</button>
            <p class="auth-switch">{{ __('site.auth.have_account') }} <a href="{{ route('login') }}">{{ __('site.nav.login') }}</a></p>
        </form>
    </section>
@endsection
