@extends('layouts.app')

@section('title', $song->title)
@section('description', $song->title.' by '.$song->group->name.'. '.$song->description)

@section('content')
    <article class="section">
        <p class="kicker"><a href="{{ route('music.index') }}">Music</a> · {{ $song->group->name }}</p>
        <div class="song-layout">
            <div class="cover" style="{{ $song->group->bandStyle() }}">
                @if ($song->posterUrl())
                    <img src="{{ $song->posterUrl() }}" alt="Poster for {{ $song->title }}">
                @else
                    <span>{{ $song->group->name }}</span>
                    <strong>{{ $song->title }}</strong>
                @endif
            </div>
            <div class="player">
                <h1 class="display">{{ $song->title }}</h1>
                <p class="meta">{{ $song->released_on->format('F Y') }} · Lyrics video · {{ $song->group->genre }}</p>
                <p>{{ $song->description }}</p>
                @if ($song->audioUrl())
                    <audio controls preload="none" src="{{ $song->audioUrl() }}">
                        <a href="{{ $song->audioUrl() }}">Play audio</a>
                    </audio>
                @endif
                <div class="actions">
                    <a class="btn btn-ink" href="{{ $song->listen_url }}" target="_blank" rel="noopener noreferrer">Listen here</a>
                    <a class="btn btn-line" href="{{ route('artists.show', $song->group) }}">{{ $song->group->name }}</a>
                </div>
                <dl class="song-credits">
                    @foreach ($song->credits() as $role => $name)
                        <div>
                            <dt>{{ $role }}</dt>
                            <dd class="{{ $name ? '' : 'pending' }}">{{ $name ?: 'To be credited' }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </article>

    @if ($related->isNotEmpty())
        <section class="section">
            <div class="section-head">
                <p class="kicker">More from {{ $song->group->name }}</p>
                <h2>Keep listening.</h2>
            </div>
            <div class="poster-grid">
                @foreach ($related as $item)
                    @include('partials.song-card', ['song' => $item])
                @endforeach
            </div>
        </section>
    @endif
@endsection
