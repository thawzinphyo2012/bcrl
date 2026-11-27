@extends('layouts.app')

@section('title', 'Copyright')
@section('description', 'Copyright notice for Big Cheese Record Label.')

@section('content')
    <article class="legal">
        <p class="kicker">Legal</p>
        <h1>Copyright notice</h1>
        <p>© 2026 Big Cheese Record Label (BCRL). All Rights Reserved.</p>
        <p>The BCRL name, the wedge mark, group names, logos, artwork, photographs, lyrics videos, and original recordings on this website belong to Big Cheese Record Label or to the artists and partners who created them, unless a credit says otherwise.</p>
        <p>Please do not copy, republish, or use this material for another project without written permission from BCRL. Listening links to official Telegram channels are there so the music can be heard from its source.</p>
        <p>If you believe something on this site uses your work without permission, write through the <a href="{{ route('business.index') }}">business form</a> and include the page and the work in question.</p>
    </article>
@endsection
