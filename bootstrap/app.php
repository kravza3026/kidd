<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EnsureModuleEnabled;
use App\Http\Middleware\EnsureSlugMatchesLocaleMiddleware;
use App\Http\Middleware\SetDefaultLocaleForUrls;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        //        web: __DIR__.'/../routes/web.php',
        //        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
        then: function () {

            Route::middleware([
                'web',
                'localize',
                'localizationRedirect',
                'localeSessionRedirect',
                'localeCookieRedirect',
            ])
                ->prefix(LaravelLocalization::setLocale())
                ->group(base_path('routes/auth.php'));

            Route::domain(config('app.api_url'))
                ->middleware('api')
                ->name('api.')
                ->prefix('v1')
                ->group(base_path('routes/api.php'));

            Route::domain(config('app.admin_url'))
                ->middleware(['web', 'auth:web', AdminMiddleware::class])
                ->name('admin.')
                ->group(base_path('routes/admin.php'));

            Route::domain(config('app.shop_url'))
                ->middleware('web')
                ->group(base_path('routes/web.php'));

        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->statefulApi();
        //        $middleware->throttleApi('api', true);

        $middleware->validateCsrfTokens(except: [
            //            'api.kidd.test/v1/*',
        ]);
        $middleware->encryptCookies(except: [
            'favorites',
        ]);

        $middleware->prependToPriorityList(
            before: SubstituteBindings::class,
            prepend: SetDefaultLocaleForUrls::class,
        );

        $middleware->appendToPriorityList(
            after: SetDefaultLocaleForUrls::class,
            append: LaravelLocalizationRoutes::class,
        );

        $middleware->alias([
            // Other Middleware aliases
            'module' => EnsureModuleEnabled::class,
            'slug.locale' => EnsureSlugMatchesLocaleMiddleware::class,
            'localize' => LaravelLocalizationRoutes::class,
            'localizationRedirect' => LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect' => LocaleSessionRedirect::class,
            'localeCookieRedirect' => LocaleCookieRedirect::class,
            'localeViewPath' => LaravelLocalizationViewPath::class,
        ]);

    })
    ->withBroadcasting(
        __DIR__.'/../routes/channels.php',
        ['prefix' => 'v1', 'middleware' => ['api', 'auth:sanctum']],
    )
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
