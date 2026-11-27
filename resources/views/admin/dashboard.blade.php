@extends('layouts.admin')

@section('title', 'Dashboard')
@section('kicker', 'Overview')
@section('heading', 'Admin dashboard')

@section('content')
    <div class="admin-stats">
        <article><strong>{{ $stats['new_applications'] }}</strong><span>New auditions</span></article>
        <article><strong>{{ $stats['new_inquiries'] }}</strong><span>New inquiries</span></article>
        <article><strong>{{ $stats['groups'] }}</strong><span>Groups</span></article>
        <article><strong>{{ $stats['members'] }}</strong><span>Members</span></article>
        <article><strong>{{ $stats['songs'] }}</strong><span>Songs</span></article>
        <article><strong>{{ $stats['news'] }}</strong><span>News posts</span></article>
    </div>

    <div class="admin-grid-2">
        <section class="admin-panel">
            <div class="admin-panel-head">
                <h2>Recent auditions</h2>
                <a href="{{ route('admin.applications.index') }}">View all</a>
            </div>
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr><th>Name</th><th>City</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($applications as $application)
                            <tr>
                                <td><a href="{{ route('admin.applications.show', $application) }}">{{ $application->full_name }}</a></td>
                                <td>{{ $application->city }}</td>
                                <td><span class="admin-badge">{{ $application->status }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="3">No applications yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section class="admin-panel">
            <div class="admin-panel-head">
                <h2>Recent inquiries</h2>
                <a href="{{ route('admin.inquiries.index') }}">View all</a>
            </div>
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr><th>Name</th><th>Service</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($inquiries as $inquiry)
                            <tr>
                                <td><a href="{{ route('admin.inquiries.show', $inquiry) }}">{{ $inquiry->name }}</a></td>
                                <td>{{ config('bcrl.services')[$inquiry->service]['title'] ?? $inquiry->service }}</td>
                                <td><span class="admin-badge">{{ $inquiry->status }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="3">No inquiries yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <div class="admin-grid-2" style="margin-top:16px">
        <section class="admin-panel">
            <div class="admin-panel-head">
                <h2>Latest songs</h2>
                <a href="{{ route('admin.songs.index') }}">Manage</a>
            </div>
            <ul class="admin-list">
                @foreach ($songs as $song)
                    <li>
                        <a href="{{ route('admin.songs.edit', $song) }}">{{ $song->title }}</a>
                        <span>{{ $song->group->name }} · {{ $song->released_on->format('M Y') }}</span>
                    </li>
                @endforeach
            </ul>
        </section>
        <section class="admin-panel">
            <div class="admin-panel-head">
                <h2>Latest news</h2>
                <a href="{{ route('admin.news.index') }}">Manage</a>
            </div>
            <ul class="admin-list">
                @foreach ($posts as $post)
                    <li>
                        <a href="{{ route('admin.news.edit', $post) }}">{{ $post->title }}</a>
                        <span>{{ $post->category }}</span>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>
@endsection
