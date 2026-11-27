@extends('layouts.app')

@section('title', 'Music')
@section('description', 'Songs, albums, and lyrics videos from the artists of Big Cheese Record Label.')

@section('content')
    <header class="page-hero about-hero">
        <div class="about-hero-media" aria-hidden="true">
            <img src="{{ asset('images/music/hero.jpg') }}" alt="">
        </div>
        <p class="hero-watermark" aria-hidden="true">MUSIC</p>
        <div class="about-hero-copy">
            <p class="kicker">03 — Music</p>
            <h1>Music that moves people.</h1>
            <p class="lede">Every song has a story. Every sound carries an emotion. From original releases and covers to collaborations and creative projects, explore the music created by the artists of Big Cheese Record Label.</p>
            <p>We believe music is more than entertainment. It is a way to express ourselves, connect with others, and create memories that last.</p>
            <div class="actions">
                <a class="btn btn-ink" href="#playlists">Listen to our music</a>
                <a class="btn btn-line" href="{{ config('bcrl.explore_url') }}" target="_blank" rel="noopener noreferrer">Explore all releases</a>
            </div>
        </div>
    </header>

    <section class="section">
        <div class="section-head">
            <p class="kicker">Latest releases</p>
            <h2>Just shared.</h2>
        </div>
        <div class="poster-grid">
            @foreach ($latest as $song)
                @include('partials.song-card', ['song' => $song])
            @endforeach
        </div>
    </section>

    <section class="section" id="playlists">
        <div class="section-head">
            <p class="kicker">Monthly song collections</p>
            <h2>Listen in the order they arrived.</h2>
            <p>Each group’s songs are gathered by month so you can move through the catalogue in sequence. A poster sits with every track. When an audio file is added, the player appears on the card.</p>
            <p class="note" lang="my">လအလိုက် နားထောင်နိုင်ရန် သီချင်းများကို လအလိုက် စီထားပါတယ်။ တရားဝင်ထွက်ရှိသည့်လနှင့် မတူပါက Studio မှာ ပြင်နိုင်ပါတယ်။</p>
        </div>
        <nav class="month-jump" aria-label="Months">
            @foreach ($months as $label => $monthSongs)
                <a href="#month-{{ \Illuminate\Support\Str::slug($label) }}">{{ $label }}</a>
            @endforeach
        </nav>
        @foreach ($months as $label => $monthSongs)
            <section class="month-block" id="month-{{ \Illuminate\Support\Str::slug($label) }}">
                <h3>{{ $label }}</h3>
                <div class="poster-grid">
                    @foreach ($monthSongs as $song)
                        @include('partials.song-card', ['song' => $song])
                    @endforeach
                </div>
            </section>
        @endforeach
    </section>

    <section class="section" id="album">
        <div class="section-head">
            <p class="kicker">The Big Cheese Album</p>
            <h2>Seven songs, highlighted.</h2>
            <p>Own song album: The Big Cheese Album. Seven tracks from across the label, held up as one listen.</p>
        </div>
        <div class="sleeve">
            <ol>
                @foreach ($highlights as $song)
                    <li>
                        <span>{{ str_pad((string) $song->highlight_position, 2, '0', STR_PAD_LEFT) }}</span>
                        <a href="{{ route('music.show', $song) }}">{{ $song->title }} <small>{{ $song->group->name }}</small></a>
                        <a href="{{ $song->listen_url }}" target="_blank" rel="noopener noreferrer">Listen</a>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section class="section" id="credits">
        <div class="section-head">
            <p class="kicker">Original songs</p>
            <h2>Highlights, with credits.</h2>
            <p>Songwriter, producer, and recording credits appear with each original. Names show as soon as BCRL confirms them.</p>
        </div>
        <div class="content-box credit-box">
            <div class="credit-list" role="table" aria-label="Song credits">
                <div class="credit credit-head" role="row">
                    <span role="columnheader">Artist / Date</span>
                    <span role="columnheader">Song</span>
                    <span role="columnheader">Role</span>
                    <span role="columnheader">Credit</span>
                </div>
                @foreach ($songs as $song)
                    <article class="credit" role="row">
                        <p class="meta credit-meta" role="cell">{{ $song->group->name }} · {{ $song->released_on->format('F Y') }}</p>
                        <div class="credit-song" role="cell">
                            <h3><a href="{{ route('music.show', $song) }}">{{ $song->title }}</a></h3>
                            <p>{{ $song->description }}</p>
                            <a class="text-link credit-listen-mobile" href="{{ $song->listen_url }}" target="_blank" rel="noopener noreferrer">Listen here</a>
                        </div>
                        <dl class="credit-roles" role="cell">
                            @foreach ($song->credits() as $role => $name)
                                <div>
                                    <dt>{{ $role }}</dt>
                                </div>
                            @endforeach
                        </dl>
                        <div class="credit-values" role="cell">
                            @foreach ($song->credits() as $role => $name)
                                <p class="{{ $name ? '' : 'pending' }}">{{ $name ?: 'To be credited' }}</p>
                            @endforeach
                            <a class="text-link" href="{{ $song->listen_url }}" target="_blank" rel="noopener noreferrer">Listen here</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-head">
            <p class="kicker">Label life</p>
            <h2>Collaborations, gatherings, programs, and achievements.</h2>
            <p>Stories from events, joint projects, programs, and milestones are published as they happen.</p>
        </div>
        <div class="chips">
            @foreach (['Events & Collaborations', 'BCRL Milestones', 'Artist Activities', 'Behind the Scenes'] as $category)
                <a href="{{ route('news.index', ['category' => $category]) }}">{{ $category }}</a>
            @endforeach
        </div>
        <div class="story-grid news-grid" style="margin-top:16px">
            @forelse ($stories as $post)
                <article class="news-card">
                    <p class="meta">{{ $post->category }}</p>
                    <h3><a href="{{ route('news.show', $post) }}">{{ $post->title }}</a></h3>
                    <p>{{ $post->excerpt }}</p>
                </article>
            @empty
                <article class="empty-card">
                    <h3>The next gathering will be written up here.</h3>
                    <p>When BCRL shares an event, a program, an award, or a collaboration, it will land in News.</p>
                </article>
            @endforelse
        </div>
    </section>

    <section class="section">
        <div class="section-head">
            <p class="kicker">Interviews</p>
            <h2>BCRL, on video.</h2>
            <p>Interviews are linked from YouTube and play on this page.</p>
        </div>
        @forelse ($interviews as $post)
            <article class="news-card">
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->excerpt }}</p>
                @if ($post->youtubeId())
                    <iframe class="frame" src="https://www.youtube-nocookie.com/embed/{{ $post->youtubeId() }}" title="{{ $post->title }}" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @endif
            </article>
        @empty
            <article class="empty-card">
                <h3>The first interview will be embedded here.</h3>
                <p>When BCRL publishes an interview on YouTube, the film will play in this section.</p>
            </article>
        @endforelse
    </section>
@endsection
