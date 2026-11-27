@extends('layouts.admin')

@section('title', $member->exists ? 'Edit member' : 'Add member')
@section('kicker', 'Artists')
@section('heading', $member->exists ? 'Edit '.$member->name : 'Add member')

@section('content')
    <form class="admin-form admin-panel" method="POST" action="{{ $member->exists ? route('admin.members.update', $member) : route('admin.members.store') }}">
        @csrf
        @if ($member->exists) @method('PUT') @endif
        <div class="admin-form-grid">
            <label class="admin-field">
                <span>Group</span>
                <select name="group_id" required>
                    <option value="">Choose group</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}" @selected((string) old('group_id', $member->group_id) === (string) $group->id)>{{ $group->name }}</option>
                    @endforeach
                </select>
            </label>
            <label class="admin-field">
                <span>Name</span>
                <input name="name" value="{{ old('name', $member->name) }}" required>
            </label>
            <label class="admin-field">
                <span>Slug</span>
                <input name="slug" value="{{ old('slug', $member->slug) }}" placeholder="auto from name">
            </label>
            <label class="admin-field">
                <span>Sort order</span>
                <input type="number" name="sort_order" min="0" max="255" value="{{ old('sort_order', $member->sort_order ?: 1) }}" required>
            </label>
            <label class="admin-field wide">
                <span>Bio</span>
                <textarea name="bio" rows="5">{{ old('bio', $member->bio) }}</textarea>
            </label>
        </div>
        <p class="admin-help">Photo: <code>public/images/members/{slug}.jpg</code></p>
        <div class="admin-form-actions">
            <button class="admin-btn admin-btn-gold" type="submit">Save member</button>
            <a class="admin-btn admin-btn-line" href="{{ route('admin.members.index') }}">Cancel</a>
        </div>
    </form>
@endsection
