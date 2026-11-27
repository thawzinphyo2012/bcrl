@extends('layouts.app')

@section('title', 'Privacy')
@section('description', 'How Big Cheese Record Label handles audition applications and partnership inquiries.')

@section('content')
    <article class="legal">
        <p class="kicker">Legal</p>
        <h1>Privacy policy</h1>
        <p>This page explains what BCRL collects when you use this website, and why.</p>
        <h2>Audition applications</h2>
        <p>The application form asks for your name, age if you share it, city, a phone number or Telegram contact, an optional email, your interest, your experience, a short note about why you want to join, and an optional demo link. BCRL uses this to review auditions and to contact selected applicants.</p>
        <h2>Partnership inquiries</h2>
        <p>The business form asks for your name, organization, email, an optional phone or Telegram contact, the kind of work you have in mind, and your message. BCRL uses this to read the proposal and reply if there is a fit.</p>
        <h2>How it is kept</h2>
        <p>Submissions are stored for the BCRL team in the studio area of this website. They are not sold. They are not used for unrelated advertising. A hidden field on each form is there to reduce automated spam.</p>
        <h2>Your request</h2>
        <p>If you want a copy of what you sent, or you want it deleted, contact BCRL through the <a href="{{ route('business.index') }}">business form</a> or the official Telegram channel and say which application or inquiry is yours.</p>
    </article>
@endsection
