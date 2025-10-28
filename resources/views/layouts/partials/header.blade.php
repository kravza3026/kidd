<header class="border-b-light-border !sticky top-0 z-10 border-b bg-white lg:relative">
    @include('layouts.nav.topline')

    <nav class="relative z-10 container flex h-[72px] justify-between font-bold lg:h-[88px]">
        <div class="flex items-center gap-10">
            <a
                href="{{ LaravelLocalization::getURLFromRouteNameTranslated(App::currentLocale(), 'home') }}"
                class="logo"
            >
                <img fetchpriority="high" src="{{ Vite::image('logo.svg') }}" alt="kidd.md Logo image" />
            </a>
        </div>

        <div class="relative z-10 hidden min-h-[60px] w-full items-center justify-between px-10 lg:flex">
            @include('layouts.nav.main-menu')
            <div data-vue-component="Search"></div>
        </div>

        @include('layouts.nav.mobile-header')

        <div class="hidden w-3/12 items-center justify-end gap-x-10 gap-y-5 lg:flex lg:w-2/12">
            <div data-vue-component="CartDropdown"></div>
            <div
                data-vue-component="UserDropdown"
                data-vue-props="{{ json_encode(['user' => auth()->user(), 'isAuthenticated' => auth()->check()]) }}"
            ></div>
        </div>
    </nav>

    @include('layouts.nav.mega-menu')
</header>
