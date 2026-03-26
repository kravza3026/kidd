
@php
    $navRoutes = [
        'about'    => LaravelLocalization::getURLFromRouteNameTranslated(App::currentLocale(), 'routes.menu.about'),
        'help'     => LaravelLocalization::getURLFromRouteNameTranslated(App::currentLocale(), 'routes.menu.help'),
        'contacts' => LaravelLocalization::getURLFromRouteNameTranslated(App::currentLocale(), 'routes.menu.contacts'),
    ];
    $menuCategories = $clothes->subcategories->map(fn($cat) => [
        'id'   => $cat->id,
        'name' => $cat->name,
        'icon' => $cat->icon,
        'url'  => $cat->translated_urls[App::currentLocale()] ?? '#',
    ]);
    $topLinks = [
        ['label' => __('header.topline.locations'), 'url' => LaravelLocalization::getURLFromRouteNameTranslated(App::currentLocale(), 'routes.topline.locations')],
        ['label' => __('header.topline.careers'),   'url' => LaravelLocalization::getURLFromRouteNameTranslated(App::currentLocale(), 'routes.topline.careers.careers')],
        ['label' => __('header.topline.terms'),     'url' => LaravelLocalization::getURLFromRouteNameTranslated(App::currentLocale(), 'routes.topline.terms')],
    ];
    $topLocales = collect(LaravelLocalization::getLocalesOrder())->map(fn($locale, $code) => [
        'code'      => $code,
        'native'    => $locale['native'],
        'url'       => LaravelLocalization::getLocalizedURL($code),
        'isCurrent' => LaravelLocalization::getCurrentLocale() === $code,
    ])->values()->all();
@endphp

<header class="border-b-light-border !sticky top-0 z-20 border-b bg-white lg:relative">
    <top-line
        :links="{{ json_encode($topLinks) }}"
        :locales="{{ json_encode($topLocales) }}"
        phone="+373 (60) 123 456"
    ></top-line>

    <nav class="relative z-[100001] container flex h-[72px] justify-between font-bold lg:h-[88px]">
        <div class="flex items-center gap-10">
            <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(App::currentLocale(), 'home') }}" class="logo">
                <img fetchpriority="high" src="{{ Vite::image('logo.svg') }}" alt="kidd.md Logo image" />
            </a>
        </div>

        <div class="relative z-[100001] hidden min-h-[60px] w-full items-center justify-between px-10 lg:flex">
            <main-menu :nav-routes="{{ json_encode($navRoutes) }}"></main-menu>
            <search-component></search-component>
        </div>

        @include('layouts.nav.mobile-header')

        <div class="hidden w-3/12 items-center justify-end gap-x-10 gap-y-5 lg:flex lg:w-2/12">
            <cart-dropdown></cart-dropdown>
            <user-dropdown :user="{{ json_encode(auth()->user()) }}" :is-authenticated="{{ json_encode(auth()->check()) }}"></user-dropdown>
        </div>
    </nav>

    <div class="relative">
        <mega-menu :categories="{{ json_encode($menuCategories) }}"></mega-menu>
    </div>
</header>
