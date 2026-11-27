@extends('layouts.admin')

@section('title', $song->exists ? 'Edit song' : 'Add song')
@section('kicker', 'Music')
@section('heading', $song->exists ? 'Edit '.$song->title : 'Add song')

@section('content')
    <form class="admin-form admin-panel" method="POST" action="{{ $song->exists ? route('admin.songs.update', $song) : route('admin.songs.store') }}">
        @csrf
        @if ($song->exists) @method('PUT') @endif
        <div class="admin-form-grid">
            <label class="admin-field">
                <span>Group</span>
                <select name="group_id" required>
                    <option value="">Choose group</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}" @selected((string) old('group_id', $song->group_id) === (string) $group->id)>{{ $group->name }}</option>
                    @endforeach
                </select>
            </label>
            <label class="admin-field">
                <span>Title</span>
                <input name="title" value="{{ old('title', $song->title) }}" required>
            </label>
            <label class="admin-field">
                <span>Slug</span>
                <input name="slug" value="{{ old('slug', $song->slug) }}" placeholder="auto from title">
            </label>
            <label class="admin-field">
                <span>Released on</span>
                <input type="date" name="released_on" value="{{ old('released_on', optional($song->released_on)->toDateString() ?? $song->released_on) }}" required>
            </label>
            <label class="admin-field wide">
                <span>Listen URL</span>
                <input type="url" name="listen_url" value="{{ old('listen_url', $song->listen_url) }}" required>
            </label>
            <label class="admin-field wide">
                <span>Description</span>
                <textarea name="description" rows="4" required>{{ old('description', $song->description) }}</textarea>
            </label>
            <label class="admin-field">
                <span>Songwriter</span>
                <input name="songwriter" value="{{ old('songwriter', $song->songwriter) }}">
            </label>
            <label class="admin-field">
                <span>Producer</span>
                <input name="producer" value="{{ old('producer', $song->producer) }}">
            </label>
            <label class="admin-field">
                <span>Recording</span>
                <input name="recording" value="{{ old('recording', $song->recording) }}">
            </label>
            <label class="admin-field">
                <span>Sort order</span>
                <input type="number" name="sort_order" min="0" max="255" value="{{ old('sort_order', $song->sort_order ?: 1) }}" required>
            </label>
            <label class="admin-check wide">
                <input type="checkbox" name="is_highlight" value="1" @checked(old('is_highlight', $song->is_highlight))>
                <span>Include in The Big Cheese Album highlights</span>
            </label>
            <label class="admin-field">
                <span>Highlight position</span>
                <input type="number" name="highlight_position" min="1" max="99" value="{{ old('highlight_position', $song->highlight_position) }}">
            </label>
        </div>
        <p class="admin-help">Poster: <code>public/images/songs/{slug}.jpg</code> · Audio: <code>public/audio/{slug}.mp3</code></p>
        <div class="admin-form-actions">
            <button class="admin-btn admin-btn-gold" type="submit">Save song</button>
            <a class="admin-btn admin-btn-line" href="{{ route('admin.songs.index') }}">Cancel</a>
        </div>
    </form>
@endsection
