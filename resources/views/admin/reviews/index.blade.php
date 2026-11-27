@extends('layouts.admin')

@section('title', 'Reviews')
@section('kicker', 'Auditions')
@section('heading', 'Member reviews')

@section('content')
    <div class="admin-toolbar">
        <p>{{ $reviews->count() }} reviews</p>
        <a class="admin-btn admin-btn-gold" href="{{ route('admin.reviews.create') }}">Add review</a>
    </div>
    <div class="admin-panel">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr><th>Name</th><th>Group</th><th>Quote</th><th></th></tr>
                </thead>
                <tbody>
                    @forelse ($reviews as $review)
                        <tr>
                            <td><strong>{{ $review->name }}</strong></td>
                            <td>{{ $review->group_name }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($review->quote, 80) }}</td>
                            <td class="admin-actions">
                                <a href="{{ route('admin.reviews.edit', $review) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}" onsubmit="return confirm('Remove this review?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No reviews yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
