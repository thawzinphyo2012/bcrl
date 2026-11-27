@extends('layouts.app')

@section('title', 'News')
@section('description', 'Official announcements, releases, auditions, and milestones from Big Cheese Record Label.')

@section('content')
    <header class="page-hero about-hero">
        <div class="about-hero-media" aria-hidden="true">
            <img src="{{ asset('images/news/hero.jpg') }}" alt="">
        </div>
        <p class="hero-watermark" aria-hidden="true">NEWS</p>
        <div class="about-hero-copy">
            <p class="kicker">07 — News</p>
            <h1>What’s happening at BCRL?</h1>
            <nav class="chips" aria-label="News categories">
                <a href="{{ route('news.index') }}" @if (! $category) aria-current="true" @endif>All</a>
                @foreach (config('bcrl.news_categories') as $item)
                    <a href="{{ route('news.index', ['category' => $item]) }}" @if ($category === $item) aria-current="true" @endif>{{ $item }}</a>
                @endforeach
            </nav>
        </div>
    </header>

    <section class="section">
        <div class="news-grid">
            @forelse ($posts as $post)
                <article class="news-card glow-card">
                    <p class="meta">{{ $post->category }} · {{ $post->published_at->format('j M Y') }}</p>
                    <h3><a href="{{ route('news.show', $post) }}">{{ $post->title }}</a></h3>
                    <p>{{ $post->excerpt }}</p>
                </article>
            @empty
                <article class="empty-card">
                    <h3>Nothing in this category yet.</h3>
                    <p>Check another category, or come back when the next update is posted.</p>
                </article>
            @endforelse
        </div>
        <div class="pager">{{ $posts->links() }}</div>
    </section>
@endsection
