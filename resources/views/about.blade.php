@extends('layouts.app')

@section('title', 'About')
@section('description', 'Purpose, mission, and vision of Big Cheese Record Label, and the people who guide it.')

@section('content')
    <header class="page-hero about-hero">
        <div class="about-hero-media" aria-hidden="true">
            <img src="{{ asset('images/about/hero.jpg') }}" alt="">
        </div>
        <p class="hero-watermark" aria-hidden="true">ABOUT</p>
        <div class="about-hero-copy">
            <p class="kicker">04 — About BCRL</p>
            <h1>Purpose, mission, vision.</h1>
            <p class="lede">Big Cheese Record Label is a Myanmar-born music and artist development label. We discover potential, nurture authentic artistry, and create music that moves people.</p>
        </div>
    </header>

    <section class="section">
        <div class="belief-grid about-pillars">
            <article class="card glow-card about-pillar">
                <div class="about-pillar-media">
                    <img src="{{ asset('images/about/belief.jpg') }}" alt="">
                </div>
                <p class="kicker">Our belief</p>
                <h3>Every potential deserves a chance to grow.</h3>
                <p>Great artists are not simply discovered. They are developed through practice, guidance, creativity, and opportunity.</p>
            </article>
            <article class="card glow-card about-pillar">
                <div class="about-pillar-media">
                    <img src="{{ asset('images/about/purpose.jpg') }}" alt="">
                </div>
                <p class="kicker">Our purpose</p>
                <h3>A voice for a new generation.</h3>
                <p>We empower Myanmar’s young creators to find their voices, develop their craft, and share meaningful music with the world.</p>
            </article>
            <article class="card glow-card about-pillar">
                <div class="about-pillar-media">
                    <img src="{{ asset('images/about/mission.jpg') }}" alt="">
                </div>
                <p class="kicker">Our mission</p>
                <h3>Develop the artist. Make the music.</h3>
                <p>Discover potential, nurture authentic artistry, and create music that moves people — with room for practice, guidance, creativity, and opportunity.</p>
            </article>
        </div>
    </section>

    <section class="section about-vision">
        <div class="about-vision-media" aria-hidden="true">
            <img src="{{ asset('images/about/vision.jpg') }}" alt="">
        </div>
        <div class="section-head about-vision-copy">
            <p class="kicker">Our vision</p>
            <h2>A home where young creators are heard.</h2>
            <p class="lede">A creative home where Myanmar’s young artists can find their voices, develop their craft, and share meaningful music with people who care about it.</p>
            <p>Whether you are an aspiring artist, a music lover, or a creative partner, there is a place for you in the BCRL universe.</p>
        </div>
    </section>

    <section class="section">
        <div class="section-head">
            <p class="kicker">Founder profile</p>
            <h2>Three roles. One shared passion.</h2>
            <p>One journey through music.</p>
        </div>
        <div class="founder-grid">
            @foreach ($founders as $founder)
                <article class="founder glow-card">
                    <div class="founder-mark">
                        <img src="{{ asset('images/bcrl-logo.png') }}" alt="" width="56" height="56">
                    </div>
                    <p class="meta">0{{ $founder->sort_order }}</p>
                    <h3>{{ $founder->name }}</h3>
                    <p class="meta">{{ $founder->role }}</p>
                    <p>{{ $founder->bio }}</p>
                </article>
            @endforeach
        </div>
    </section>

    @include('partials.finale')
@endsection
