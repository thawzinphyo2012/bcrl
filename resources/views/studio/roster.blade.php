@extends('layouts.app')

@section('title', 'Roster')

@section('content')
    <section class="studio">
        @include('partials.studio-nav')
        <p class="kicker">Roster</p>
        <h1 class="display" style="font-size:clamp(2.2rem,4vw,3.6rem)">Member bios.</h1>
        <p>Photos are files, not a form. Save a portrait as <code>public/images/members/{slug}.jpg</code>. Logos use <code>public/images/groups/{slug}.png</code>. Song posters use <code>public/images/songs/{slug}.jpg</code>. Audio uses <code>public/audio/{slug}.mp3</code>.</p>
        @foreach ($groups as $group)
            <h2>{{ $group->name }}</h2>
            <div class="studio-list">
                @foreach ($group->members as $member)
                    <form class="studio-card" method="POST" action="{{ route('studio.members.update', $member) }}">
                        @csrf
                        @method('PATCH')
                        <h3>{{ $member->name }}</h3>
                        <p class="meta">{{ $member->slug }}</p>
                        <label class="field">
                            <span>Bio</span>
                            <textarea name="bio" maxlength="800">{{ old('bio', $member->bio) }}</textarea>
                        </label>
                        <button class="btn btn-ink" type="submit">Save {{ $member->name }}</button>
                    </form>
                @endforeach
            </div>
        @endforeach
    </section>
@endsection
