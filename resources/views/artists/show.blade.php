@extends('layouts.app')

@section('title', $group->name)
@section('description', $group->name.' — '.$group->concept.'. '.$group->summary)

@section('content')
    <section class="section">
        <header class="identity" style="{{ $group->bandStyle() }}">
            <div class="logo-slot">
                @if ($group->logoUrl())
                    <img src="{{ $group->logoUrl() }}" alt="{{ $group->name }} logo">
                @else
                    @include('partials.mark', ['class' => 'mark-group', 'alt' => 'BCRL', 'width' => 96, 'height' => 96])
                @endif
            </div>
            <div>
                <p class="kicker">Group 0{{ $group->sort_order }}</p>
                <h1>{{ $group->name }}</h1>
                <p>{{ $group->concept }}</p>
                <p>{{ $group->members->count() }} members · {{ $group->genre }}</p>
                <div class="actions">
                    <a class="btn btn-gold" href="{{ $group->telegram_url }}" target="_blank" rel="noopener noreferrer">Official channel</a>
                    <a class="btn btn-line" href="{{ route('artists.index') }}">All artists</a>
                </div>
            </div>
        </header>
        <p class="lede" style="margin-top:18px">{{ $group->summary }}</p>
    </section>

    <section class="section">
        <div class="section-head">
            <p class="kicker">Member profiles</p>
            <h2>The people inside {{ $group->name }}.</h2>
            <p>{{ $group->members->count() }} members of {{ $group->name }}.</p>
        </div>
        <ul class="member-grid" style="{{ $group->bandStyle() }}">
            @foreach ($group->members as $member)
                <li class="member">
                    <div class="portrait">
                        @if ($member->photoUrl())
                            <img src="{{ $member->photoUrl() }}" alt="{{ $member->name }} of {{ $group->name }}">
                        @else
                            <span>{{ $member->initials() }}</span>
                        @endif
                    </div>
                    <h3>{{ $member->name }}</h3>
                    @if ($member->bio)
                        <p>{{ $member->bio }}</p>
                    @endif
                </li>
            @endforeach
        </ul>
    </section>

    <section class="section">
        <div class="section-head">
            <p class="kicker">Latest songs</p>
            <h2>Lyrics videos.</h2>
        </div>
        <div class="poster-grid">
            @foreach ($group->songs as $song)
                @include('partials.song-card', ['song' => $song])
            @endforeach
        </div>
    </section>
@endsection
