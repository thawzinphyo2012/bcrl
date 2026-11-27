@extends('layouts.app')

@section('title', 'Catalogue')

@section('content')
    <section class="studio">
        @include('partials.studio-nav')
        <p class="kicker">Catalogue</p>
        <h1 class="display" style="font-size:clamp(2.2rem,4vw,3.6rem)">Credits and release months.</h1>
        <p>Songwriter, producer, and recording names appear on the music page. Change a month if the listening order should move.</p>
        <div class="studio-list">
            @foreach ($songs as $song)
                <form class="studio-card" method="POST" action="{{ route('studio.songs.update', $song) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="_song" value="{{ $song->id }}">
                    <h3>{{ $song->title }}</h3>
                    <p class="meta">{{ $song->group->name }}</p>
                    @php $editing = (string) old('_song') === (string) $song->id; @endphp
                    <div class="form-grid">
                        <label class="field">
                            <span>Released</span>
                            <input type="date" name="released_on" value="{{ $editing ? old('released_on', $song->released_on->toDateString()) : $song->released_on->toDateString() }}" required>
                        </label>
                        <label class="field">
                            <span>Songwriter</span>
                            <input type="text" name="songwriter" value="{{ $editing ? old('songwriter', $song->songwriter) : $song->songwriter }}" maxlength="160">
                        </label>
                        <label class="field">
                            <span>Producer</span>
                            <input type="text" name="producer" value="{{ $editing ? old('producer', $song->producer) : $song->producer }}" maxlength="160">
                        </label>
                        <label class="field">
                            <span>Recording</span>
                            <input type="text" name="recording" value="{{ $editing ? old('recording', $song->recording) : $song->recording }}" maxlength="160">
                        </label>
                        <label class="field wide">
                            <span>Description</span>
                            <textarea name="description" required maxlength="1000">{{ $editing ? old('description', $song->description) : $song->description }}</textarea>
                        </label>
                    </div>
                    <button class="btn btn-ink" type="submit">Save {{ $song->title }}</button>
                </form>
            @endforeach
        </div>
    </section>
@endsection
