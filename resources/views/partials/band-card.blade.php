<a class="band glow-card" href="{{ route('artists.show', $group) }}" style="{{ $group->bandStyle() }}">
    <em>0{{ $group->sort_order }}</em>
    <span class="band-main">
        @if ($group->logoUrl())
            <img class="band-logo" src="{{ $group->logoUrl() }}" alt="{{ $group->name }} logo">
        @endif
        <span class="band-copy">
            <b>{{ $group->name }}</b>
            <small>
                @isset($membersLabel)
                    {{ $membersLabel }}
                @else
                    {{ $group->members_count }} members · {{ $group->genre }}
                @endisset
            </small>
        </span>
    </span>
    <small class="band-meta">
        @isset($meta)
            {!! $meta !!}
        @else
            {{ $group->concept }}
        @endisset
    </small>
    <span class="band-go" aria-hidden="true"></span>
</a>
