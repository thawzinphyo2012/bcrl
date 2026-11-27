@extends('layouts.app')

@section('title', 'Studio')

@section('content')
    <header class="page-hero">
        <p class="kicker">Studio</p>
        <h1>The desk.</h1>
        <p class="lede">Applications, partnership notes, credits, and member bios live here.</p>
    </header>
    <section class="section">
        <form class="form" method="POST" action="{{ route('studio.login.store') }}">
            @csrf
            <label class="field">
                <span>Email</span>
                <input name="email" type="email" value="{{ old('email') }}" required autocomplete="username">
                @error('email') <p class="field-error">{{ $message }}</p> @enderror
            </label>
            <label class="field">
                <span>Password</span>
                <input name="password" type="password" required autocomplete="current-password">
            </label>
            <label class="check">
                <input type="checkbox" name="remember" value="1">
                <span>Keep me signed in on this browser</span>
            </label>
            <button class="btn btn-ink" type="submit">Enter studio</button>
        </form>
    </section>
@endsection
