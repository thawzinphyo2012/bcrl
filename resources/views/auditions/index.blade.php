@extends('layouts.app')

@section('title', 'Auditions')
@section('description', 'Join BCRL. Discover your voice, show your potential, and apply for auditions.')

@section('content')
    <header class="page-hero about-hero auditions-hero">
        <div class="about-hero-media" aria-hidden="true">
            <img src="{{ asset('images/auditions/hero.jpg') }}" alt="">
        </div>
        <p class="hero-watermark" aria-hidden="true">JOIN</p>
        <div class="about-hero-copy">
            <p class="kicker">05 — Auditions</p>
            <h1 class="display">Every artist starts somewhere.</h1>
            <p class="lede">At BCRL, we look beyond what you can do today. We look for potential, dedication, creativity, willingness to learn, and the desire to grow.</p>
            <p>If music matters to you, this could be your starting point. Discover your potential. Develop your craft. Find your voice.</p>
            <div class="actions">
                <a class="btn btn-gold" href="{{ route('auditions.apply') }}">Apply now</a>
                <a class="btn btn-line" href="#faq">Frequently asked questions</a>
            </div>
        </div>
    </header>

    <section class="section">
        <div class="section-head">
            <p class="kicker">Join BCRL</p>
            <h2>Discover your voice. Show your potential.</h2>
            <p>Do you love music and want to share your talent with others? BCRL welcomes passionate individuals who are interested in singing, creating music, and being part of a collaborative music community.</p>
            <p>You don’t have to be a professional artist to take your first step. Bring your passion, show us your potential, and let your journey begin.</p>
        </div>
        <div class="belief-grid about-pillars">
            <article class="card glow-card about-pillar">
                <div class="about-pillar-media">
                    <img src="{{ asset('images/auditions/start.jpg') }}" alt="">
                </div>
                <p class="meta">01</p>
                <h3>Apply</h3>
                <p>Click Apply Now to complete the separate BCRL Audition Application Form.</p>
            </article>
            <article class="card glow-card about-pillar">
                <div class="about-pillar-media">
                    <img src="{{ asset('images/auditions/join.jpg') }}" alt="">
                </div>
                <p class="meta">02</p>
                <h3>Review</h3>
                <p>Applicants submit their materials through the application form. The BCRL team reviews submissions and contacts selected applicants with further information about the next steps.</p>
            </article>
            <article class="card glow-card about-pillar">
                <div class="about-pillar-media">
                    <img src="{{ asset('images/auditions/grow.jpg') }}" alt="">
                </div>
                <p class="meta">03</p>
                <h3>Grow</h3>
                <p>Successful applicants will receive further information about membership, upcoming activities, and participation opportunities.</p>
            </article>
        </div>
        <div class="actions">
            <a class="btn btn-gold" href="{{ route('auditions.apply') }}">Apply now</a>
        </div>
        <p class="note">Apply now opens the BCRL audition application form.</p>
    </section>

    <section class="section" id="faq">
        <div class="section-head">
            <p class="kicker">FAQ</p>
            <h2>Seven questions, in English and Myanmar.</h2>
        </div>
        <div class="faq">
            @foreach (config('bcrl.faq') as $index => $item)
                <details @if ($index === 0) open @endif>
                    <summary>
                        <span>{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                        <span>
                            <strong>{{ $item['en_q'] }}</strong>
                            <em lang="my">{{ $item['my_q'] }}</em>
                        </span>
                    </summary>
                    <p>{{ $item['en_a'] }}</p>
                    <p lang="my">{{ $item['my_a'] }}</p>
                </details>
            @endforeach
        </div>
    </section>

    <section class="section" id="reviews">
        <div class="section-head">
            <p class="kicker">Member reviews</p>
            <h2>Hear it from our members.</h2>
            <p>Every artist has a different journey. This is where members speak about their experiences, creative projects, and time with BCRL.</p>
        </div>
        <div class="news-grid">
            @forelse ($reviews as $review)
                <blockquote class="review">
                    <p>“{{ $review->quote }}”</p>
                    <footer>
                        <strong>{{ $review->name }}</strong>
                        <span class="meta">{{ $review->group_name }}</span>
                    </footer>
                </blockquote>
            @empty
                <article class="empty-card">
                    <h3>Member stories will be published here.</h3>
                    <p>Notes from people inside BCRL will appear as review cards once they are ready to share.</p>
                </article>
            @endforelse
        </div>
    </section>
@endsection
