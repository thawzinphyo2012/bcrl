@extends('layouts.admin')

@section('title', $founder->exists ? 'Edit founder' : 'Add founder')
@section('kicker', 'About')
@section('heading', $founder->exists ? 'Edit '.$founder->name : 'Add founder')

@section('content')
    <form class="admin-form admin-panel" method="POST" action="{{ $founder->exists ? route('admin.founders.update', $founder) : route('admin.founders.store') }}">
        @csrf
        @if ($founder->exists) @method('PUT') @endif
        <div class="admin-form-grid">
            <label class="admin-field">
                <span>Name</span>
                <input name="name" value="{{ old('name', $founder->name) }}" required>
            </label>
            <label class="admin-field">
                <span>Role</span>
                <input name="role" value="{{ old('role', $founder->role) }}" required>
            </label>
            <label class="admin-field">
                <span>Sort order</span>
                <input type="number" name="sort_order" min="0" max="255" value="{{ old('sort_order', $founder->sort_order ?: 1) }}" required>
            </label>
            <label class="admin-field wide">
                <span>Bio</span>
                <textarea name="bio" rows="5" required>{{ old('bio', $founder->bio) }}</textarea>
            </label>
        </div>
        <div class="admin-form-actions">
            <button class="admin-btn admin-btn-gold" type="submit">Save founder</button>
            <a class="admin-btn admin-btn-line" href="{{ route('admin.founders.index') }}">Cancel</a>
        </div>
    </form>
@endsection
