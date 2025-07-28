<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Discover adorable outfits for your little joy! From cozy onesies to trendy outfits, we have everything you need to keep your baby stylish, comfortable and oh-so-cute.">
        <title>{{ config('app.name') }} - Moldova</title>

        @stack('meta')

        <!-- Favicons -->
        <link rel="icon" type="image/x-icon" sizes="32x32" href="{{ Vite::image('common/favicon_32x32.ico') }}">
        <link rel="icon" type="image/x-icon" sizes="16x16" href="{{ Vite::image('common/favicon_16x16.ico') }}">
        <link rel="icon" type="image/x-icon" href="{{ Vite::image('common/favicon.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('head')
    </head>
    <body>
        @include('layouts.partials.header')
        <main @class(['page-fade','bg-white','min-h-[100vh]', '!bg-[#FAFAFA]' => request()->is('*/account/*')])>
            {{ $slot }}
        </main>
        @include('layouts.partials.footer')

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

        @stack('scripts')
    </body>
</html>
