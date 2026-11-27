@extends('layouts.app')

@section('title', 'Not found')

@section('content')
    <header class="page-hero blank-hero">
        <p class="hero-watermark" aria-hidden="true">404</p>
        <p class="kicker">404</p>
        <h1>This side of the record is blank.</h1>
        <p class="lede">That page is not on the label. Try the artists, the music, or the front door.</p>
        <div class="actions">
            <a class="btn btn-ink" href="{{ route('home') }}">Back home</a>
            <a class="btn btn-line" href="{{ route('music.index') }}">Listen</a>
        </div>
    </header>
@endsection
