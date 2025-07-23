<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }} - Moldova</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @include('layouts.header')
        <main class="bg-white page-fade">
            {{ $slot }}
        </main>
        @include('layouts.footer')

{{--        @include('layouts.nav.mobile')--}}
        <div data-vue-component="mobileMenu" data-vue-props="{{ json_encode(['user' => auth()->user(), 'isAuthenticated' => auth()->check()]) }}"></div>
        <div data-vue-component="ScrollToTop"></div>
        <div class="backdrop fixed inset-0 bg-black/70 z-[2]"
             x-data
             x-cloak
             x-show="$store.dropdown.open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95 "
             x-transition:enter-end="opacity-100 "
        ></div>

    </body>
</html>
