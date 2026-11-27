@extends('layouts.admin')

@section('title', $group->exists ? 'Edit group' : 'Add group')
@section('kicker', 'Artists')
@section('heading', $group->exists ? 'Edit '.$group->name : 'Add group')

@section('content')
    <form class="admin-form admin-panel" method="POST" action="{{ $group->exists ? route('admin.groups.update', $group) : route('admin.groups.store') }}">
        @csrf
        @if ($group->exists) @method('PUT') @endif
        <div class="admin-form-grid">
            <label class="admin-field">
                <span>Name</span>
                <input name="name" value="{{ old('name', $group->name) }}" required>
            </label>
            <label class="admin-field">
                <span>Slug @if($group->exists)<em>(optional change)</em>@endif</span>
                <input name="slug" value="{{ old('slug', $group->slug) }}" @unless($group->exists) placeholder="auto from name" @endunless>
            </label>
            <label class="admin-field">
                <span>Concept</span>
                <input name="concept" value="{{ old('concept', $group->concept) }}" required>
            </label>
            <label class="admin-field">
                <span>Genre</span>
                <input name="genre" value="{{ old('genre', $group->genre) }}" required>
            </label>
            <label class="admin-field wide">
                <span>Summary</span>
                <textarea name="summary" rows="4" required>{{ old('summary', $group->summary) }}</textarea>
            </label>
            <label class="admin-field">
                <span>Accent</span>
                <input name="accent" type="color" value="{{ old('accent', $group->accent ?: '#1a120c') }}" required>
            </label>
            <label class="admin-field">
                <span>Accent ink</span>
                <input name="accent_ink" type="color" value="{{ old('accent_ink', $group->accent_ink ?: '#e2a322') }}" required>
            </label>
            <label class="admin-field">
                <span>Telegram URL</span>
                <input name="telegram_url" type="url" value="{{ old('telegram_url', $group->telegram_url) }}" required>
            </label>
            <label class="admin-field">
                <span>Sort order</span>
                <input name="sort_order" type="number" min="0" max="255" value="{{ old('sort_order', $group->sort_order) }}" required>
            </label>
        </div>
        <p class="admin-help">Logo file: <code>public/images/groups/{slug}.png</code></p>
        <div class="admin-form-actions">
            <button class="admin-btn admin-btn-gold" type="submit">Save group</button>
            <a class="admin-btn admin-btn-line" href="{{ route('admin.groups.index') }}">Cancel</a>
        </div>
    </form>
@endsection
