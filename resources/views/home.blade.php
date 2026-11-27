@extends('layouts.app')

@section('title', __('site.nav.home'))
@section('description', __('site.home.lede'))

@section('content')
    <section class="hero about-hero home-hero">
        <div class="about-hero-media" aria-hidden="true">
            <img src="{{ asset('images/home/hero.jpg') }}" alt="">
        </div>
        <p class="hero-watermark" aria-hidden="true">BCRL</p>
        <div class="hero-copy about-hero-copy">
            <p class="eyebrow">{{ __('site.home.eyebrow') }}</p>
            <h1 class="display">{{ __('site.home.tagline') }}</h1>
            <p class="typewriter" data-typewriter data-text="{{ __('site.home.type') }}" aria-label="{{ __('site.home.type') }}"><span data-type-text></span><span class="type-caret" aria-hidden="true"></span></p>
            <p class="lede">{{ __('site.home.lede') }}</p>
            <div class="actions">
                <a class="btn btn-gold" href="{{ route('artists.index') }}">{{ __('site.home.meet') }}</a>
                <a class="btn btn-line" href="{{ route('auditions.apply') }}">{{ __('site.home.apply') }}</a>
                <a class="btn btn-line" href="{{ route('music.index') }}">{{ __('site.home.listen') }}</a>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-head">
            <p class="kicker">{{ __('site.home.brand_kicker') }}</p>
            <h2>{{ __('site.home.brand_title') }}</h2>
        </div>
        <div class="belief-grid about-pillars">
            <article class="card glow-card about-pillar">
                <div class="about-pillar-media">
                    <img src="{{ asset('images/home/belief1.jpg') }}" alt="">
                </div>
                <h3>{{ __('site.home.belief_1_title') }}</h3>
                <p>{{ __('site.home.belief_1_text') }}</p>
            </article>
            <article class="card glow-card about-pillar">
                <div class="about-pillar-media">
                    <img src="{{ asset('images/home/belief2.jpg') }}" alt="">
                </div>
                <h3>{{ __('site.home.belief_2_title') }}</h3>
                <p>{{ __('site.home.belief_2_text') }}</p>
            </article>
            <article class="card glow-card about-pillar">
                <div class="about-pillar-media">
                    <img src="{{ asset('images/home/belief3.jpg') }}" alt="">
                </div>
                <h3>{{ __('site.home.belief_3_title') }}</h3>
                <p>{{ __('site.home.belief_3_text') }}</p>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="section-head">
            <p class="kicker">{{ __('site.home.artists_kicker') }}</p>
            <h2>{{ __('site.home.artists_title') }}</h2>
            <p>{{ __('site.home.artists_text') }}</p>
        </div>
        <div class="band-list">
            @foreach ($groups as $group)
                @include('partials.band-card', ['group' => $group])
            @endforeach
        </div>
    </section>

    <section class="section about-vision">
        <div class="about-vision-media" aria-hidden="true">
            <img src="{{ asset('images/home/album.jpg') }}" alt="">
        </div>
        <div class="section-head about-vision-copy">
            <p class="kicker">{{ __('site.home.album_kicker') }}</p>
            <h2>{{ __('site.home.album_title') }}</h2>
            <p>{{ __('site.home.album_text') }}</p>
            <div class="sleeve">
                <p class="kicker">{{ __('site.home.tracklist') }}</p>
                <ol>
                    @foreach ($highlights as $song)
                        <li>
                            <span>{{ str_pad((string) $song->highlight_position, 2, '0', STR_PAD_LEFT) }}</span>
                            <a href="{{ route('music.show', $song) }}">{{ $song->title }}</a>
                            <span>{{ $song->group->name }}</span>
                        </li>
                    @endforeach
                </ol>
                <div class="actions">
                    <a class="btn btn-gold" href="{{ route('music.index') }}">{{ __('site.home.listen') }}</a>
                    <a class="btn btn-line" href="{{ config('bcrl.explore_url') }}" target="_blank" rel="noopener noreferrer">{{ __('site.home.explore') }}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section about-vision news-feature">
        <div class="section-head about-vision-copy">
            <p class="kicker">{{ __('site.home.news_kicker') }}</p>
            <h2>{{ __('site.home.news_title') }}</h2>
            <div class="news-grid">
                @foreach ($posts as $post)
                    <article class="news-card glow-card">
                        <p class="meta">{{ $post->category }} · {{ $post->published_at->format('j M Y') }}</p>
                        <h3><a href="{{ route('news.show', $post) }}">{{ $post->title }}</a></h3>
                        <p>{{ $post->excerpt }}</p>
                    </article>
                @endforeach
            </div>
            <p><a class="btn btn-ink" href="{{ route('news.index') }}">{{ __('site.home.view_news') }}</a></p>
        </div>
        <div class="about-vision-media" aria-hidden="true">
            <img src="{{ asset('images/home/news.jpg') }}" alt="">
        </div>
    </section>

    @include('partials.finale')
@endsection
