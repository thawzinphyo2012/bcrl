@extends('layouts.admin')

@section('title', $review->exists ? 'Edit review' : 'Add review')
@section('kicker', 'Auditions')
@section('heading', $review->exists ? 'Edit review' : 'Add review')

@section('content')
    <form class="admin-form admin-panel" method="POST" action="{{ $review->exists ? route('admin.reviews.update', $review) : route('admin.reviews.store') }}">
        @csrf
        @if ($review->exists) @method('PUT') @endif
        <div class="admin-form-grid">
            <label class="admin-field">
                <span>Name</span>
                <input name="name" value="{{ old('name', $review->name) }}" required>
            </label>
            <label class="admin-field">
                <span>Group name</span>
                <input name="group_name" value="{{ old('group_name', $review->group_name) }}" required>
            </label>
            <label class="admin-field wide">
                <span>Quote</span>
                <textarea name="quote" rows="5" required>{{ old('quote', $review->quote) }}</textarea>
            </label>
        </div>
        <div class="admin-form-actions">
            <button class="admin-btn admin-btn-gold" type="submit">Save review</button>
            <a class="admin-btn admin-btn-line" href="{{ route('admin.reviews.index') }}">Cancel</a>
        </div>
    </form>
@endsection
