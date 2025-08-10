<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

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

            Route::middleware('web')
                ->domain(config('app.admin_url'))
                ->name('admin.')
                ->group(base_path('routes/admin.php'));

            Route::middleware('api')
                ->domain(config('app.api_url'))
                ->name('api.')
                ->prefix('v1')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->domain(config('app.shop_url'))
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
            before: \Illuminate\Routing\Middleware\SubstituteBindings::class,
            prepend: \App\Http\Middleware\SetDefaultLocaleForUrls::class,
        );

        $middleware->appendToPriorityList(
            after: \App\Http\Middleware\SetDefaultLocaleForUrls::class,
            append: \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
        );

        $middleware->alias([
            // Other Middleware aliases
            'localize'                => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect'    => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect'   => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect'    => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'localeViewPath'          => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,
        ]);

    })
//    ->withBroadcasting(
//        __DIR__.'/../routes/channels.php',
//        ['prefix' => 'v1', 'middleware' => ['api', 'auth:sanctum']],
//    )
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
