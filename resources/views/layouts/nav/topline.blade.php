<div class="bg-light-orange hidden lg:block">
    <div class="container flex justify-between">
        <div class="flex-1 flex items-center gap-5">
            <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated( App::currentLocale(), 'routes.topline.locations') }}" class="text-[13px] font-medium">
                {{ __('header.topline.locations') }}
            </a>
            <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated( App::currentLocale(), 'routes.topline.careers') }}" class="text-[13px] font-medium">
                {{ __('header.topline.careers') }}
            </a>
            <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated( App::currentLocale(), 'routes.topline.terms') }}" class="text-[13px] font-medium">
                {{ __('header.topline.terms') }}
            </a>
        </div>
        <div class="flex-1 flex justify-end gap-5 items-center">
            @include('layouts.partials._lang_switcher')
            <a href="tel:+37360123456" class="text-[13px] font-medium">+373 (60) 123 456</a>
        </div>
    </div>
</div>
