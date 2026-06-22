<!DOCTYPE html>
<html class="h-full bg-white" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config('app.name', 'KIDD.MD') }}</title>
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

        <!-- Scripts -->
        @vite(['resources/js/admin.js', 'resources/css/app.css'])
    </head>
    <body class="font-onest h-full font-normal antialiased">
        <!-- Mobile sidebar -->
        @include('layouts.admin.sidebar_mobile')

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            @include('layouts.admin.sidebar_desktop')
        </div>

        <div class="lg:pl-72">
            <!-- Header -->
            @include('layouts.admin.header')

            <main class="py-10">
                <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
                    <x-admin.flash />
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
