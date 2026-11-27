@extends('layouts.app')

@section('title', 'Artists')
@section('description', 'Meet the artists of Big Cheese Record Label. Five identities. Different sounds. One creative home.')

@section('content')
    <header class="page-hero about-hero">
        <div class="about-hero-media" aria-hidden="true">
            <img src="{{ asset('images/artists/hero.jpg') }}" alt="">
        </div>
        <p class="hero-watermark" aria-hidden="true">ARTISTS</p>
        <div class="about-hero-copy">
            <p class="kicker">02 — Artists</p>
            <h1>Meet the artists of BCRL.</h1>
            <p class="lede">Five identities. Different sounds. One creative home. Discover the artists and groups of Big Cheese Record Label. Each group brings its own identity, musical direction, and creative expression.</p>
        </div>
    </header>

    <section class="section">
        <div class="band-list">
            @foreach ($groups as $group)
                @include('partials.band-card', [
                    'group' => $group,
                    'membersLabel' => $group->concept,
                    'meta' => e($group->members_count).' members<br>'.e($group->genre),
                ])
            @endforeach
        </div>
    </section>
@endsection
