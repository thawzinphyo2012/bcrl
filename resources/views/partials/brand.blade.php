<a class="brand {{ $class ?? '' }}" href="{{ $href ?? route('home') }}">
    @include('partials.mark', [
        'alt' => 'Big Cheese Record Label',
        'width' => $size ?? 40,
        'height' => $size ?? 40,
        'class' => $markClass ?? '',
    ])
    @unless ($logoOnly ?? false)
        <span class="brand-text">
            <strong>BCRL</strong>
            @if (! empty($subtitle))
                <em>{{ $subtitle }}</em>
            @endif
        </span>
    @endunless
</a>
