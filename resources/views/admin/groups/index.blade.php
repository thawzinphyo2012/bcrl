@extends('layouts.admin')

@section('title', 'Groups')
@section('kicker', 'Artists')
@section('heading', 'Groups')

@section('content')
    <div class="admin-toolbar">
        <p>{{ $groups->count() }} groups on the roster</p>
        <a class="admin-btn admin-btn-gold" href="{{ route('admin.groups.create') }}">Add group</a>
    </div>
    <div class="admin-panel">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Concept</th>
                        <th>Members</th>
                        <th>Songs</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groups as $group)
                        <tr>
                            <td>{{ $group->sort_order }}</td>
                            <td>
                                <strong>{{ $group->name }}</strong>
                                <div class="admin-muted">{{ $group->slug }}</div>
                            </td>
                            <td>{{ $group->concept }}</td>
                            <td>{{ $group->members_count }}</td>
                            <td>{{ $group->songs_count }}</td>
                            <td class="admin-actions">
                                <a href="{{ route('artists.show', $group) }}" target="_blank">View</a>
                                <a href="{{ route('admin.groups.edit', $group) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.groups.destroy', $group) }}" onsubmit="return confirm('Delete this group and its members/songs?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
