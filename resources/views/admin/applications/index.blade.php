@extends('layouts.admin')

@section('title', 'Auditions')
@section('kicker', 'Inbox')
@section('heading', 'Audition applications')

@section('content')
    <div class="admin-toolbar">
        <div class="admin-chips">
            <a href="{{ route('admin.applications.index') }}" @if (! $status) aria-current="true" @endif>All</a>
            @foreach (['new', 'reviewed', 'archived'] as $item)
                <a href="{{ route('admin.applications.index', ['status' => $item]) }}" @if ($status === $item) aria-current="true" @endif>{{ ucfirst($item) }}</a>
            @endforeach
        </div>
    </div>
    <div class="admin-panel">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr><th>Name</th><th>City</th><th>Interest</th><th>Status</th><th>Submitted</th><th></th></tr>
                </thead>
                <tbody>
                    @forelse ($applications as $application)
                        <tr>
                            <td><strong>{{ $application->full_name }}</strong></td>
                            <td>{{ $application->city }}</td>
                            <td>{{ config('bcrl.interests')[$application->interest] ?? $application->interest }}</td>
                            <td><span class="admin-badge">{{ $application->status }}</span></td>
                            <td>{{ $application->created_at->format('Y-m-d H:i') }}</td>
                            <td class="admin-actions">
                                <a href="{{ route('admin.applications.show', $application) }}">Open</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6">No applications.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="admin-pager">{{ $applications->links() }}</div>
    </div>
@endsection
