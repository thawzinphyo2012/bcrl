@php
    $links = [
        ['route' => 'home', 'match' => 'home', 'no' => '01', 'label' => __('site.nav.home')],
        ['route' => 'artists.index', 'match' => 'artists.*', 'no' => '02', 'label' => __('site.nav.artists')],
        ['route' => 'music.index', 'match' => 'music.*', 'no' => '03', 'label' => __('site.nav.music')],
        ['route' => 'about', 'match' => 'about', 'no' => '04', 'label' => __('site.nav.about')],
        ['route' => 'auditions.index', 'match' => 'auditions.*', 'no' => '05', 'label' => __('site.nav.auditions')],
        ['route' => 'business.index', 'match' => 'business.*', 'no' => '06', 'label' => __('site.nav.business')],
        ['route' => 'news.index', 'match' => 'news.*', 'no' => '07', 'label' => __('site.nav.news')],
    ];

    if (auth()->check()) {
        $links[] = ['route' => 'dashboard', 'match' => 'dashboard', 'no' => '08', 'label' => __('site.nav.dashboard')];
    } else {
        $links[] = ['route' => 'login', 'match' => 'login', 'no' => '08', 'label' => __('site.nav.account')];
    }

    $locale = app()->getLocale();
    $localeCycle = ['en' => 'my', 'my' => 'zh', 'zh' => 'en'];
    $nextLocale = $localeCycle[$locale] ?? 'en';
    $nextLocaleLabel = __('site.lang.'.$nextLocale);
@endphp

<header class="site-header">
    @include('partials.brand', ['logoOnly' => true, 'size' => 44, 'markClass' => 'mark-header'])
    <div class="header-actions">
        <button
            class="icon-pill"
            type="button"
            data-theme-toggle
            aria-label="{{ __('site.theme.to_light') }}"
            title="{{ __('site.theme.to_light') }}"
        >
            <span data-theme-icon aria-hidden="true">☀</span>
        </button>

        <form method="POST" action="{{ route('locale.update') }}" class="lang-form">
            @csrf
            <input type="hidden" name="locale" value="{{ $nextLocale }}">
            <button class="lang-pill" type="submit" aria-label="{{ __('site.lang.switch') }}" title="{{ __('site.lang.switch') }}: {{ $nextLocaleLabel }}">
                {{ $nextLocaleLabel }}
            </button>
        </form>

        @auth
            <a class="lang-pill auth-pill" href="{{ route('dashboard') }}">{{ __('site.nav.dashboard') }}</a>
        @else
            <a class="lang-pill auth-pill" href="{{ route('login') }}">{{ __('site.nav.account') }}</a>
        @endauth

        <button class="nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="site-menu" aria-label="{{ __('site.nav.open_menu') }}">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

<div class="nav-drawer" id="site-menu" data-nav hidden>
    <button class="nav-backdrop" type="button" data-nav-backdrop aria-label="{{ __('site.nav.close_menu') }}"></button>
    <div class="nav-panel" role="dialog" aria-modal="true" aria-label="{{ __('site.nav.menu') }}">
        <div class="nav-panel-top">
            @include('partials.brand', ['logoOnly' => true, 'size' => 48, 'markClass' => 'mark-header'])
            <button class="nav-close" type="button" data-nav-toggle>{{ __('site.nav.close') }}</button>
        </div>
        <nav aria-label="Primary">
            @foreach ($links as $link)
                <a href="{{ route($link['route']) }}" @if (request()->routeIs($link['match'])) aria-current="page" @endif>
                    <span>{{ $link['no'] }}</span>
                    <span>{{ $link['label'] }}</span>
                </a>
            @endforeach
        </nav>

        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-line" type="submit">{{ __('site.nav.logout') }}</button>
            </form>
        @endauth

        <p class="nav-foot">{{ config('bcrl.motto') }}</p>
    </div>
</div>
