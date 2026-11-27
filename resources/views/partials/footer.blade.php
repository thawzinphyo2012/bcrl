<footer class="footer">
    <div>
        @include('partials.brand', ['size' => 48, 'markClass' => 'mark-footer', 'subtitle' => 'Big Cheese Record Label'])
        <p>{{ __('site.footer.blurb') }}</p>
        <p class="copy">© 2026 Big Cheese Record Label (BCRL)</p>
    </div>
    <div>
        <h2>{{ __('site.footer.explore') }}</h2>
        <ul>
            <li><a href="{{ route('home') }}">{{ __('site.nav.home') }}</a></li>
            <li><a href="{{ route('artists.index') }}">{{ __('site.nav.artists') }}</a></li>
            <li><a href="{{ route('music.index') }}">{{ __('site.nav.music') }}</a></li>
            <li><a href="{{ route('about') }}">{{ __('site.nav.about') }}</a></li>
            <li><a href="{{ route('auditions.index') }}">{{ __('site.nav.auditions') }}</a></li>
            <li><a href="{{ route('business.index') }}">{{ __('site.nav.business') }}</a></li>
            <li><a href="{{ route('news.index') }}">{{ __('site.nav.news') }}</a></li>
        </ul>
    </div>
    <div>
        <h2>{{ __('site.footer.social') }}</h2>
        <ul>
            @foreach (config('bcrl.socials') as $social)
                <li>
                    @if ($social['url'])
                        <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer">{{ $social['label'] }}</a>
                    @else
                        <span class="soon">{{ $social['label'] }} · {{ __('site.footer.soon') }}</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    <div>
        <h2>{{ __('site.footer.legal') }}</h2>
        <ul>
            <li><a href="{{ route('legal.copyright') }}">{{ __('site.footer.copyright') }}</a></li>
            <li><a href="{{ route('legal.privacy') }}">{{ __('site.footer.privacy') }}</a></li>
            <li><a href="{{ route('legal.terms') }}">{{ __('site.footer.terms') }}</a></li>
            <li><a href="{{ route('admin.login') }}">{{ __('site.footer.admin') }}</a></li>
        </ul>
    </div>
</footer>
