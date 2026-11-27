@php
    $links = [
        ['route' => 'admin.dashboard', 'match' => 'admin.dashboard', 'label' => 'Dashboard'],
        ['route' => 'admin.groups.index', 'match' => 'admin.groups.*', 'label' => 'Groups'],
        ['route' => 'admin.members.index', 'match' => 'admin.members.*', 'label' => 'Members'],
        ['route' => 'admin.songs.index', 'match' => 'admin.songs.*', 'label' => 'Songs'],
        ['route' => 'admin.news.index', 'match' => 'admin.news.*', 'label' => 'News'],
        ['route' => 'admin.founders.index', 'match' => 'admin.founders.*', 'label' => 'Founders'],
        ['route' => 'admin.reviews.index', 'match' => 'admin.reviews.*', 'label' => 'Reviews'],
        ['route' => 'admin.applications.index', 'match' => 'admin.applications.*', 'label' => 'Auditions'],
        ['route' => 'admin.inquiries.index', 'match' => 'admin.inquiries.*', 'label' => 'Inquiries'],
        ['route' => 'admin.translations.index', 'match' => 'admin.translations.*', 'label' => 'Languages'],
        ['route' => 'admin.settings.edit', 'match' => 'admin.settings.*', 'label' => 'Settings'],
    ];
@endphp

<aside class="admin-sidebar">
    @include('partials.brand', [
        'href' => route('admin.dashboard'),
        'size' => 40,
        'subtitle' => 'Admin',
        'markClass' => 'mark-header',
    ])
    <nav aria-label="Admin">
        @foreach ($links as $link)
            <a href="{{ route($link['route']) }}" @if (request()->routeIs($link['match'])) aria-current="page" @endif>
                {{ $link['label'] }}
            </a>
        @endforeach
    </nav>
    <p class="admin-side-note">{{ config('bcrl.motto') }}</p>
</aside>
