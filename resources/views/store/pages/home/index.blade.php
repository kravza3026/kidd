<x-app-layout>
    @push('meta')
        @foreach(['en', 'ro', 'ru'] as $lang)
            <link rel="alternate" hreflang="{{ $lang }}" href="{{ url('/') }}/{{ $lang }}" />
        @endforeach
        <link rel="alternate" hreflang="x-default" href="{{ config('app.url') }}/{{ config('app.locale') }}" />
    @endpush

    <div class="pageContent">

        {{-- Main banner at the top of the homepage --}}
        @include('store.pages.home.sections.mainBanner')

        {{-- Quick access to categories (e.g., Men, Women, Kids) --}}
        @include('store.pages.home.sections.fastCategories')
        {{-- Section displaying newly arrived products --}}
        @include('store.pages.home.sections.newArrivals')

        {{-- Newsletter subscription block --}}
        @include('store.pages.home.sections.mainSubscribe')

        {{-- Gender-specific promotional banners --}}
        @include('store.pages.home.sections.genderBanners')

    </div>
</x-app-layout>
