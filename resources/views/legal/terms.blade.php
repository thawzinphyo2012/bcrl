@extends('layouts.app')

@section('title', 'Terms')
@section('description', 'Terms and conditions for using the Big Cheese Record Label website.')

@section('content')
    <article class="legal">
        <p class="kicker">Legal</p>
        <h1>Terms & conditions</h1>
        <p>By using this website you agree to these terms. If you do not agree, please leave the site.</p>
        <h2>The site</h2>
        <p>This website introduces Big Cheese Record Label, its groups, its music, its auditions, and ways to propose a partnership. Content can change as the label’s work changes.</p>
        <h2>Auditions</h2>
        <p>Sending an application does not guarantee a place, a reply, training, or membership. Eligibility for a particular audition is set by that announcement. If you are selected, BCRL will share the next steps, including any requirements.</p>
        <h2>Partnerships</h2>
        <p>A message sent through the business form is a proposal. It becomes a project only when both sides agree in a separate conversation. Listing a service on this site is an invitation to talk, not a promise of a booking.</p>
        <h2>Listening links</h2>
        <p>Some songs open on Telegram, YouTube, or other services. Those destinations have their own terms. BCRL is not responsible for how those services operate.</p>
        <h2>Use of material</h2>
        <p>Do not copy the label’s music, artwork, names, or text for your own commercial use without permission. See the <a href="{{ route('legal.copyright') }}">copyright notice</a>.</p>
    </article>
@endsection
