@php
    $canonicalUrl = url()->current();
    $page = request()->query('page');
    if ($page && (int) $page > 1) {
        $canonicalUrl .= '?page=' . (int) $page;
    }

    $queryParams = request()->query();
    unset($queryParams['page']);
    $hasFilterParams = !empty($queryParams);
@endphp

<link rel="canonical" href="{{ urldecode($canonicalUrl) }}" />

@if($hasFilterParams)
    <meta name="robots" content="noindex, follow" />
@endif

@foreach (config('app.locales', []) as $locale => $name)
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
    @if ($locale == 'ro')
        <link
            rel="alternate"
            hreflang="x-default"
            href="{{ LaravelLocalization::getLocalizedURL($locale, url()->current(), request()->route()->parameters()) }}"
        />
    @endif
@endforeach
