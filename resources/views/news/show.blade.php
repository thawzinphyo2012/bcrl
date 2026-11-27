@extends('layouts.app')

@section('title', $post->title)
@section('description', $post->excerpt)

@section('content')
    <article class="section legal">
        <p class="kicker"><a href="{{ route('news.index') }}">News</a> · {{ $post->category }}</p>
        <h1>{{ $post->title }}</h1>
        <p class="meta">{{ $post->published_at->format('j F Y') }}</p>
        @foreach ($post->paragraphs() as $paragraph)
            <p>{{ $paragraph }}</p>
        @endforeach
        @if ($post->youtubeId())
            <iframe class="frame" src="https://www.youtube-nocookie.com/embed/{{ $post->youtubeId() }}" title="{{ $post->title }}" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        @endif
    </article>

    @if ($others->isNotEmpty())
        <section class="section">
            <div class="section-head">
                <h2>More news</h2>
            </div>
            <div class="news-grid">
                @foreach ($others as $other)
                    <article class="news-card">
                        <p class="meta">{{ $other->category }}</p>
                        <h3><a href="{{ route('news.show', $other) }}">{{ $other->title }}</a></h3>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
@endsection
