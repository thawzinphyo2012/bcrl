@extends('layouts.admin')

@section('title', $application->full_name)
@section('kicker', 'Inbox')
@section('heading', $application->full_name)

@section('content')
    <div class="admin-grid-2">
        <section class="admin-panel">
            <h2>Application</h2>
            <dl class="admin-dl">
                <div><dt>Age</dt><dd>{{ $application->age ?: '—' }}</dd></div>
                <div><dt>City</dt><dd>{{ $application->city }}</dd></div>
                <div><dt>Contact</dt><dd>{{ $application->contact }}</dd></div>
                <div><dt>Email</dt><dd>{{ $application->email ?: '—' }}</dd></div>
                <div><dt>Interest</dt><dd>{{ config('bcrl.interests')[$application->interest] ?? $application->interest }}</dd></div>
                <div><dt>Experience</dt><dd>{{ config('bcrl.experiences')[$application->experience] ?? $application->experience }}</dd></div>
                <div><dt>Demo</dt><dd>
                    @if ($application->demo_url)
                        <a href="{{ $application->demo_url }}" target="_blank" rel="noopener">Open link</a>
                    @else
                        —
                    @endif
                </dd></div>
                <div><dt>Submitted</dt><dd>{{ $application->created_at->format('j M Y, H:i') }}</dd></div>
            </dl>
            <h3>Why BCRL</h3>
            <p>{{ $application->why }}</p>
        </section>
        <section class="admin-panel">
            <h2>Status</h2>
            <form method="POST" action="{{ route('admin.applications.update', $application) }}" class="admin-form">
                @csrf
                @method('PATCH')
                <label class="admin-field">
                    <span>Status</span>
                    <select name="status">
                        @foreach (['new', 'reviewed', 'archived'] as $status)
                            <option value="{{ $status }}" @selected($application->status === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </label>
                <button class="admin-btn admin-btn-gold" type="submit">Update status</button>
            </form>
            <form method="POST" action="{{ route('admin.applications.destroy', $application) }}" onsubmit="return confirm('Delete this application?')" style="margin-top:16px">
                @csrf
                @method('DELETE')
                <button class="admin-btn admin-btn-line" type="submit">Delete application</button>
            </form>
            <p style="margin-top:16px"><a href="{{ route('admin.applications.index') }}">← Back to list</a></p>
        </section>
    </div>
@endsection
