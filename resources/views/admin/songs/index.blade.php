@extends('layouts.admin')

@section('title', 'Songs')
@section('kicker', 'Music')
@section('heading', 'Songs')

@section('content')
    <div class="admin-toolbar">
        <form method="GET" class="admin-inline">
            <select name="group" onchange="this.form.submit()">
                <option value="">All groups</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}" @selected($groupId === $group->id)>{{ $group->name }}</option>
                @endforeach
            </select>
        </form>
        <a class="admin-btn admin-btn-gold" href="{{ route('admin.songs.create') }}">Add song</a>
    </div>
    <div class="admin-panel">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr><th>Title</th><th>Group</th><th>Released</th><th>Album</th><th></th></tr>
                </thead>
                <tbody>
                    @forelse ($songs as $song)
                        <tr>
                            <td>
                                <strong>{{ $song->title }}</strong>
                                <div class="admin-muted">{{ $song->slug }}</div>
                            </td>
                            <td>{{ $song->group->name }}</td>
                            <td>{{ $song->released_on->format('Y-m-d') }}</td>
                            <td>{{ $song->is_highlight ? '#'.$song->highlight_position : '—' }}</td>
                            <td class="admin-actions">
                                <a href="{{ route('music.show', $song) }}" target="_blank">View</a>
                                <a href="{{ route('admin.songs.edit', $song) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.songs.destroy', $song) }}" onsubmit="return confirm('Delete this song?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No songs found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
