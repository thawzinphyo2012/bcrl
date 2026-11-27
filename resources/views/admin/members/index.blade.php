@extends('layouts.admin')

@section('title', 'Members')
@section('kicker', 'Artists')
@section('heading', 'Members')

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
        <a class="admin-btn admin-btn-gold" href="{{ route('admin.members.create', array_filter(['group' => $groupId])) }}">Add member</a>
    </div>
    <div class="admin-panel">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr><th>#</th><th>Name</th><th>Group</th><th>Bio</th><th></th></tr>
                </thead>
                <tbody>
                    @forelse ($members as $member)
                        <tr>
                            <td>{{ $member->sort_order }}</td>
                            <td>
                                <strong>{{ $member->name }}</strong>
                                <div class="admin-muted">{{ $member->slug }}</div>
                            </td>
                            <td>{{ $member->group->name }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($member->bio, 60) ?: '—' }}</td>
                            <td class="admin-actions">
                                <a href="{{ route('admin.members.edit', $member) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.members.destroy', $member) }}" onsubmit="return confirm('Delete this member?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No members found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
