@extends('layouts.admin')

@section('title', 'News')
@section('kicker', 'Content')
@section('heading', 'News')

@section('content')
    <div class="admin-toolbar">
        <p>{{ $posts->count() }} posts</p>
        <a class="admin-btn admin-btn-gold" href="{{ route('admin.news.create') }}">Add news</a>
    </div>
    <div class="admin-panel">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr><th>Title</th><th>Category</th><th>Published</th><th></th></tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td>
                                <strong>{{ $post->title }}</strong>
                                <div class="admin-muted">{{ $post->slug }}</div>
                            </td>
                            <td>{{ $post->category }}</td>
                            <td>{{ $post->published_at->format('Y-m-d H:i') }}</td>
                            <td class="admin-actions">
                                <a href="{{ route('news.show', $post) }}" target="_blank">View</a>
                                <a href="{{ route('admin.news.edit', $post) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.news.destroy', $post) }}" onsubmit="return confirm('Delete this post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No news yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
