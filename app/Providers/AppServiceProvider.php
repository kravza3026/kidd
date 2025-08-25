<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Gender;
use App\Models\ProductVariant;
use App\Models\Region;
use App\Models\Season;
use App\Models\Size;
use App\Observers\ProductVariantObserver;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Number;
use Illuminate\Support\ServiceProvider;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use NumberFormatter;

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
        //        Model::automaticallyEagerLoadRelationships();
        Model::preventLazyLoading(! $this->app->isProduction());

        ProductVariant::observe(ProductVariantObserver::class);

        //        Vite::prefetch(7);
        //        Vite::useWaterfallPrefetching(7);
        Vite::useAggressivePrefetching();

        Vite::macro('font', fn (string $asset) => $this->asset("resources/fonts/{$asset}"));
        Vite::macro('css', fn (string $asset) => $this->asset("resources/css/{$asset}"));
        Vite::macro('js', fn (string $asset) => $this->asset("resources/js/{$asset}"));
        Vite::macro('image', fn (string $asset) => $this->asset("resources/images/{$asset}"));

        Request::macro('validatedExcept', function ($except = []) {
            return Arr::except($this->validated(), $except);
        });

        Number::useLocale(config('app.locale_format'));
        Carbon::setLocale(app()->getLocale());

        Blade::stringable('Money', function (Money $money) {
            $currencies = new ISOCurrencies;
            $numberFormatter = new NumberFormatter(config('app.locale_format'), NumberFormatter::CURRENCY);
            $numberFormatter->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
            $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

            return $moneyFormatter->format($money);

            //            $money = new Money(round(1234.56789, -2, PHP_ROUND_HALF_EVEN), new Currency('MDL'));
            //            $currencies = new ISOCurrencies();
            //
            //            $numberFormatter = new \NumberFormatter(app()->getLocale(), \NumberFormatter::CURRENCY_CODE);
            //            $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);
            //
            //            echo $moneyFormatter->format($money); // outputs $1.00

        });

        if (! app()->runningInConsole()) {
            // Share cached data with views, globally

            $regions = Cache::rememberForever('regions', function () {
                return Region::all();
            });

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

            View::share('regions', $regions);
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
