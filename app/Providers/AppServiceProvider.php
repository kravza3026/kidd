<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Gender;
use App\Models\Season;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Number;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Vite::prefetch(7);
        Vite::useWaterfallPrefetching(7);
//        Vite::useAggressivePrefetching();

        Vite::macro('font', fn (string $asset) => $this->asset("resources/fonts/{$asset}"));
        Vite::macro('css', fn (string $asset) => $this->asset("resources/css/{$asset}"));
        Vite::macro('js', fn (string $asset) => $this->asset("resources/js/{$asset}"));
        Vite::macro('image', fn (string $asset) => $this->asset("resources/images/{$asset}"));

        Number::useLocale(config('app.locale_format'));
        Carbon::setLocale(app()->getLocale());

        Blade::stringable(function (Money $money) {
            $currencies = new ISOCurrencies;
            $numberFormatter = new NumberFormatter(config('app.locale_format'), NumberFormatter::CURRENCY);
            $numberFormatter->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
            $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

            return $moneyFormatter->format($money);
        });

        if (! app()->runningInConsole()) {
            // Share cached data with views, globally
            $brands = Cache::rememberForever('brands', function () {
                return Brand::all();
            });
            $genders = Cache::rememberForever('genders', function () {
                return Gender::all();
            });
            $seasons = Cache::rememberForever('seasons', function () {
                return Season::all();
            });
            $sizes = Cache::rememberForever('sizes', function () {
                return Size::all();
            });
            $colors = Cache::rememberForever('colors', function () {
                return Color::all();
            });
            $categories = Cache::rememberForever('categories', function () {
                return Category::all();
            });
            // Cache the first top-level category with its subcategories
            $clothes = Cache::rememberForever('clothes', function () {
                return Category::with('subcategories')->whereNull('parent_id')->first();
            });

            View::share('brands', $brands);
            View::share('genders', $genders);
            View::share('seasons', $seasons);
            View::share('colors', $colors);
            View::share('sizes', $sizes);
            View::share('categories', $categories);
            View::share('clothes', $clothes);

        }

    }
}
