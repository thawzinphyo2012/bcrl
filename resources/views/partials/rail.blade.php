@php
    $links = [
        ['route' => 'home', 'match' => 'home', 'no' => '01', 'label' => 'Home'],
        ['route' => 'artists.index', 'match' => 'artists.*', 'no' => '02', 'label' => 'Artists'],
        ['route' => 'music.index', 'match' => 'music.*', 'no' => '03', 'label' => 'Music'],
        ['route' => 'about', 'match' => 'about', 'no' => '04', 'label' => 'About'],
        ['route' => 'auditions.index', 'match' => 'auditions.*', 'no' => '05', 'label' => 'Auditions'],
        ['route' => 'business.index', 'match' => 'business.*', 'no' => '06', 'label' => 'Business'],
        ['route' => 'news.index', 'match' => 'news.*', 'no' => '07', 'label' => 'News'],
    ];
@endphp

<aside class="rail" id="primary-nav" data-nav>
    <div>
        <a class="brand" href="{{ route('home') }}">
            @include('partials.mark')
            <strong>BCRL</strong>
        </a>
        <nav aria-label="Primary">
            @foreach ($links as $link)
                <a href="{{ route($link['route']) }}" @if (request()->routeIs($link['match'])) aria-current="page" @endif>
                    <span>{{ $link['no'] }}</span>
                    <span>{{ $link['label'] }}</span>
                </a>
            @endforeach
        </nav>
    </div>
    <p class="rail-foot">{{ config('bcrl.motto') }}</p>
</aside>
