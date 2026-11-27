@extends('layouts.admin')

@section('title', 'Inquiries')
@section('kicker', 'Inbox')
@section('heading', 'Partnership inquiries')

@section('content')
    <div class="admin-toolbar">
        <div class="admin-chips">
            <a href="{{ route('admin.inquiries.index') }}" @if (! $status) aria-current="true" @endif>All</a>
            @foreach (['new', 'reviewed', 'archived'] as $item)
                <a href="{{ route('admin.inquiries.index', ['status' => $item]) }}" @if ($status === $item) aria-current="true" @endif>{{ ucfirst($item) }}</a>
            @endforeach
        </div>
    </div>
    <div class="admin-panel">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr><th>Name</th><th>Organization</th><th>Service</th><th>Status</th><th>Submitted</th><th></th></tr>
                </thead>
                <tbody>
                    @forelse ($inquiries as $inquiry)
                        <tr>
                            <td><strong>{{ $inquiry->name }}</strong></td>
                            <td>{{ $inquiry->organization ?: '—' }}</td>
                            <td>{{ config('bcrl.services')[$inquiry->service]['title'] ?? $inquiry->service }}</td>
                            <td><span class="admin-badge">{{ $inquiry->status }}</span></td>
                            <td>{{ $inquiry->created_at->format('Y-m-d H:i') }}</td>
                            <td class="admin-actions">
                                <a href="{{ route('admin.inquiries.show', $inquiry) }}">Open</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6">No inquiries.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="admin-pager">{{ $inquiries->links() }}</div>
    </div>
@endsection
