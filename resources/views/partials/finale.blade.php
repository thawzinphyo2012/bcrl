<section class="finale finale-decor">
    <div class="finale-media" aria-hidden="true">
        <img src="{{ asset('images/shared/finale.jpg') }}" alt="">
    </div>
    <div class="finale-copy">
        <p class="kicker">{{ __('site.finale.kicker') }}</p>
        <h2>{{ __('site.finale.title') }}</h2>
        <p>{{ __('site.finale.text') }}</p>
        <div class="actions">
            <a class="btn btn-gold" href="{{ route('auditions.apply') }}">{{ __('site.finale.apply') }}</a>
            <a class="btn btn-line" href="{{ route('music.index') }}">{{ __('site.finale.listen') }}</a>
        </div>
    </div>
</section>
