<header class="lg:relative z-10 sticky top-0 bg-white border-b border-b-light-border">
    @include('layouts.nav.topline')

    <nav class="container relative z-10 h-[72px] lg:h-[88px] flex justify-between font-bold">
        <div class="flex items-center gap-10">
            <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated( App::currentLocale(), 'home') }}" class="logo">
                <img src="{{ Vite::image('logo.svg') }}" alt="kidd.md Logo image">
            </a>
        </div>

        <div class="w-full relative z-10   min-h-[60px] px-10 items-center justify-between hidden lg:flex">
            @include('layouts.nav.main-menu')
            <div data-vue-component="Search"></div>
        </div>

        @include('layouts.nav.mobile-header')

        <div class="hidden lg:flex w-3/12 lg:w-2/12 items-center gap-y-5 gap-x-10 justify-end">
            <div data-vue-component="CartDropdown"></div>
            <div data-vue-component="UserDropdown" data-vue-props="{{ json_encode(['user' => auth()->user(), 'isAuthenticated' => auth()->check()]) }}"></div>
        </div>

    </nav>

    @include('layouts.nav.mega-menu')
</header>
