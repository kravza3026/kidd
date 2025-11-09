@foreach (array_keys(config('app.locales')) as $locale)
    @if (request()->route()->hasParameters())
        @if (request()->route()->hasParameter('product'))
            @php
                $url = request()->route()->parameter('product', [])?->translated_urls[$locale];
            @endphp
        @elseif (request()->route()->hasParameter('category'))
            @php
                $url = request()->route()->parameter('category', [])?->translated_urls[$locale];
            @endphp
        @elseif (request()->route()->hasParameter('vacancy'))
            @php
                $url = request()->route()->parameter('vacancy', [])?->translated_urls[$locale];
            @endphp
        @endif
    @endif

    <link
        rel="alternate"
        hreflang="{{ $locale }}"
        href="{{ LaravelLocalization::localizeUrl($url ?? LaravelLocalization::getLocalizedURL($locale, url()->current(), request()->route()->parameters()), $locale) }}"
    />
    @if ($locale == config('app.locale'))
        <link
            rel="alternate"
            hreflang="x-default"
            href="{{ $url ?? LaravelLocalization::getLocalizedURL($locale, url()->current(), request()->route()->parameters()) }}"
        />
    @endif
@endforeach
