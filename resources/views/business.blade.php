@extends('layouts.app')

@section('title', 'Business')
@section('description', 'Music production, vocal services, artist collaboration, and brand partnerships with Big Cheese Record Label.')

@php
    $serviceImages = [
        'production' => 'images/business/production.jpg',
        'vocals' => 'images/business/vocals.jpg',
        'collaboration' => 'images/business/collab.jpg',
        'brand' => 'images/business/hero.jpg',
        'content' => 'images/home/album.jpg',
        'training' => 'images/auditions/join.jpg',
    ];
@endphp

@section('content')
    <header class="page-hero about-hero">
        <div class="about-hero-media" aria-hidden="true">
            <img src="{{ asset('images/business/hero.jpg') }}" alt="">
        </div>
        <p class="hero-watermark" aria-hidden="true">STUDIO</p>
        <div class="about-hero-copy">
            <p class="kicker">06 — Business</p>
            <h1>Let’s create something meaningful.</h1>
            <p class="lede">BCRL welcomes creative collaborations and partnerships that share our commitment to quality, originality, and meaningful artistic expression.</p>
            <p>We aim to connect artists, producers, brands, creators, and organizations to develop music, creative projects, and opportunities that create value for both our partners and our audiences.</p>
        </div>
    </header>

    <section class="section">
        <div class="service-grid about-pillars">
            @foreach (config('bcrl.services') as $key => $service)
                <article class="service glow-card about-pillar">
                    @if (! empty($serviceImages[$key]))
                        <div class="about-pillar-media">
                            <img src="{{ asset($serviceImages[$key]) }}" alt="">
                        </div>
                    @endif
                    <h3>{{ $service['title'] }}</h3>
                    <p>{{ $service['text'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section" id="inquire">
        <div class="section-head">
            <p class="kicker">For business inquiries</p>
            <h2>Music projects, brand collaborations, or partnership proposals.</h2>
            <p>Connect with the team. This note is read by BCRL. It is a proposal, not a confirmed project.</p>
        </div>
        <form class="form" method="POST" action="{{ route('business.store') }}">
            @csrf
            <div class="honeypot" aria-hidden="true">
                <label for="company_website">Website</label>
                <input id="company_website" type="text" name="company_website" tabindex="-1" autocomplete="off">
            </div>
            <div class="form-grid">
                <label class="field">
                    <span>Name</span>
                    <input name="name" value="{{ old('name') }}" required maxlength="120" autocomplete="name">
                    @error('name') <p class="field-error">{{ $message }}</p> @enderror
                </label>
                <label class="field">
                    <span>Organization</span>
                    <input name="organization" value="{{ old('organization') }}" maxlength="160">
                    @error('organization') <p class="field-error">{{ $message }}</p> @enderror
                </label>
                <label class="field">
                    <span>Email</span>
                    <input name="email" type="email" value="{{ old('email') }}" required maxlength="160" autocomplete="email">
                    @error('email') <p class="field-error">{{ $message }}</p> @enderror
                </label>
                <label class="field">
                    <span>Phone or Telegram</span>
                    <input name="phone" value="{{ old('phone') }}" maxlength="160">
                    @error('phone') <p class="field-error">{{ $message }}</p> @enderror
                </label>
                <label class="field wide">
                    <span>What are you exploring?</span>
                    <select name="service" required>
                        <option value="" @selected(old('service') === null) disabled>Choose a service</option>
                        @foreach (config('bcrl.services') as $value => $service)
                            <option value="{{ $value }}" @selected(old('service') === $value)>{{ $service['title'] }}</option>
                        @endforeach
                    </select>
                    @error('service') <p class="field-error">{{ $message }}</p> @enderror
                </label>
                <label class="field wide">
                    <span>Your proposal</span>
                    <textarea name="message" required minlength="20" maxlength="3000">{{ old('message') }}</textarea>
                    @error('message') <p class="field-error">{{ $message }}</p> @enderror
                </label>
            </div>
            <button class="btn btn-ink" type="submit">Send to BCRL</button>
        </form>
    </section>
@endsection
