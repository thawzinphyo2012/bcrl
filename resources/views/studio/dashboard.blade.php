@extends('layouts.app')

@section('title', 'Studio desk')

@section('content')
    <section class="studio">
        @include('partials.studio-nav')
        <p class="kicker">Desk</p>
        <h1 class="display" style="font-size:clamp(2.2rem,4vw,3.6rem)">Applications and notes.</h1>
        <p>{{ $counts['new_applications'] }} new applications · {{ $counts['applications'] }} total · {{ $counts['inquiries'] }} inquiries</p>

        <h2>Auditions</h2>
        <div class="studio-list">
            @forelse ($applications as $application)
                <article class="studio-card">
                    <h3>{{ $application->full_name }}</h3>
                    <p class="meta">{{ $application->created_at->format('j M Y, H:i') }} · {{ $application->city }} @if ($application->age) · age {{ $application->age }} @endif</p>
                    <p>{{ config('bcrl.interests')[$application->interest] ?? $application->interest }} · {{ config('bcrl.experiences')[$application->experience] ?? $application->experience }}</p>
                    <p>{{ $application->contact }} @if ($application->email) · {{ $application->email }} @endif</p>
                    <p>{{ $application->why }}</p>
                    @if ($application->demo_url && str_starts_with($application->demo_url, 'http'))
                        <p><a href="{{ $application->demo_url }}" target="_blank" rel="noopener noreferrer">Demo link</a></p>
                    @endif
                    <form class="inline" method="POST" action="{{ route('studio.auditions.update', $application) }}">
                        @csrf
                        @method('PATCH')
                        <label>
                            <span class="meta">Status</span>
                            <select name="status">
                                @foreach (['new', 'reviewed', 'archived'] as $status)
                                    <option value="{{ $status }}" @selected($application->status === $status)>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </label>
                        <button class="btn btn-ink" type="submit">Save</button>
                    </form>
                </article>
            @empty
                <p>No applications yet.</p>
            @endforelse
        </div>

        <h2>Partnerships</h2>
        <div class="studio-list">
            @forelse ($inquiries as $inquiry)
                <article class="studio-card">
                    <h3>{{ $inquiry->name }} @if ($inquiry->organization) · {{ $inquiry->organization }} @endif</h3>
                    <p class="meta">{{ $inquiry->created_at->format('j M Y, H:i') }} · {{ config('bcrl.services')[$inquiry->service]['title'] ?? $inquiry->service }}</p>
                    <p>{{ $inquiry->email }} @if ($inquiry->phone) · {{ $inquiry->phone }} @endif</p>
                    <p>{{ $inquiry->message }}</p>
                    <form class="inline" method="POST" action="{{ route('studio.inquiries.update', $inquiry) }}">
                        @csrf
                        @method('PATCH')
                        <select name="status">
                            @foreach (['new', 'reviewed', 'archived'] as $status)
                                <option value="{{ $status }}" @selected($inquiry->status === $status)>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-ink" type="submit">Save</button>
                    </form>
                </article>
            @empty
                <p>No inquiries yet.</p>
            @endforelse
        </div>

        <h2>Member reviews</h2>
        <form class="form" method="POST" action="{{ route('studio.reviews.store') }}">
            @csrf
            <div class="form-grid">
                <label class="field">
                    <span>Name</span>
                    <input name="name" value="{{ old('name') }}" required maxlength="80">
                </label>
                <label class="field">
                    <span>Group</span>
                    <input name="group_name" value="{{ old('group_name') }}" required maxlength="80">
                </label>
                <label class="field wide">
                    <span>Their words</span>
                    <textarea name="quote" required maxlength="600">{{ old('quote') }}</textarea>
                </label>
            </div>
            @if ($errors->any())
                <p class="field-error">Check the review fields and try again.</p>
            @endif
            <button class="btn btn-ink" type="submit">Publish review</button>
        </form>
        <div class="studio-list" style="margin-top:14px">
            @foreach ($reviews as $review)
                <article class="studio-card">
                    <h3>{{ $review->name }} · {{ $review->group_name }}</h3>
                    <p>{{ $review->quote }}</p>
                    <form method="POST" action="{{ route('studio.reviews.destroy', $review) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-line" type="submit">Remove</button>
                    </form>
                </article>
            @endforeach
        </div>
    </section>
@endsection
