@extends('layouts.admin')

@section('title', $post->exists ? 'Edit news' : 'Add news')
@section('kicker', 'Content')
@section('heading', $post->exists ? 'Edit news' : 'Add news')

@section('content')
    <form class="admin-form admin-panel" method="POST" action="{{ $post->exists ? route('admin.news.update', $post) : route('admin.news.store') }}">
        @csrf
        @if ($post->exists) @method('PUT') @endif
        <div class="admin-form-grid">
            <label class="admin-field wide">
                <span>Title</span>
                <input name="title" value="{{ old('title', $post->title) }}" required>
            </label>
            <label class="admin-field">
                <span>Slug</span>
                <input name="slug" value="{{ old('slug', $post->slug) }}" placeholder="auto from title">
            </label>
            <label class="admin-field">
                <span>Category</span>
                <select name="category" required>
                    @foreach (config('bcrl.news_categories') as $category)
                        <option value="{{ $category }}" @selected(old('category', $post->category) === $category)>{{ $category }}</option>
                    @endforeach
                </select>
            </label>
            <label class="admin-field">
                <span>Published at</span>
                <input type="datetime-local" name="published_at" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\TH:i')) }}" required>
            </label>
            <label class="admin-field">
                <span>YouTube URL</span>
                <input type="url" name="youtube_url" value="{{ old('youtube_url', $post->youtube_url) }}">
            </label>
            <label class="admin-field wide">
                <span>Excerpt</span>
                <textarea name="excerpt" rows="3" required>{{ old('excerpt', $post->excerpt) }}</textarea>
            </label>
            <label class="admin-field wide">
                <span>Body</span>
                <textarea name="body" rows="10" required>{{ old('body', $post->body) }}</textarea>
            </label>
        </div>
        <div class="admin-form-actions">
            <button class="admin-btn admin-btn-gold" type="submit">Save news</button>
            <a class="admin-btn admin-btn-line" href="{{ route('admin.news.index') }}">Cancel</a>
        </div>
    </form>
@endsection
