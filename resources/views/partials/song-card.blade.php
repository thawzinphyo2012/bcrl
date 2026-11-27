<article class="song-card glow-card">
    <a class="cover {{ $song->posterUrl() ? 'has-poster' : '' }}" href="{{ route('music.show', $song) }}" style="{{ $song->group->bandStyle() }}">
        @if ($song->posterUrl())
            <img src="{{ $song->posterUrl() }}" alt="{{ $song->title }}">
            <span>{{ $song->group->name }}</span>
            <strong>{{ $song->title }}</strong>
        @else
            <span>{{ $song->group->name }}</span>
            <strong>{{ $song->title }}</strong>
        @endif
    </a>
    <p class="meta">{{ $song->group->name }} · {{ $song->released_on->format('M Y') }}</p>
    <h3><a href="{{ route('music.show', $song) }}">{{ $song->title }}</a></h3>
    @if ($song->audioUrl())
        <audio controls preload="none" src="{{ $song->audioUrl() }}">
            <a href="{{ $song->audioUrl() }}">Play audio</a>
        </audio>
    @endif
    <p><a class="text-link" href="{{ $song->listen_url }}" target="_blank" rel="noopener noreferrer">Listen here</a></p>
</article>
