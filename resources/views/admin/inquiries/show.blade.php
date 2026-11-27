@extends('layouts.admin')

@section('title', $inquiry->name)
@section('kicker', 'Inbox')
@section('heading', $inquiry->name)

@section('content')
    <div class="admin-grid-2">
        <section class="admin-panel">
            <h2>Inquiry</h2>
            <dl class="admin-dl">
                <div><dt>Organization</dt><dd>{{ $inquiry->organization ?: '—' }}</dd></div>
                <div><dt>Email</dt><dd><a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></dd></div>
                <div><dt>Phone</dt><dd>{{ $inquiry->phone ?: '—' }}</dd></div>
                <div><dt>Service</dt><dd>{{ config('bcrl.services')[$inquiry->service]['title'] ?? $inquiry->service }}</dd></div>
                <div><dt>Submitted</dt><dd>{{ $inquiry->created_at->format('j M Y, H:i') }}</dd></div>
            </dl>
            <h3>Message</h3>
            <p>{{ $inquiry->message }}</p>
        </section>
        <section class="admin-panel">
            <h2>Status</h2>
            <form method="POST" action="{{ route('admin.inquiries.update', $inquiry) }}" class="admin-form">
                @csrf
                @method('PATCH')
                <label class="admin-field">
                    <span>Status</span>
                    <select name="status">
                        @foreach (['new', 'reviewed', 'archived'] as $status)
                            <option value="{{ $status }}" @selected($inquiry->status === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </label>
                <button class="admin-btn admin-btn-gold" type="submit">Update status</button>
            </form>
            <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}" onsubmit="return confirm('Delete this inquiry?')" style="margin-top:16px">
                @csrf
                @method('DELETE')
                <button class="admin-btn admin-btn-line" type="submit">Delete inquiry</button>
            </form>
            <p style="margin-top:16px"><a href="{{ route('admin.inquiries.index') }}">← Back to list</a></p>
        </section>
    </div>
@endsection
