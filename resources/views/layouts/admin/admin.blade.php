<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        @auth
            <meta name="user-id" content="{{ auth()->id() }}" />
        @endauth

        <title>{{ config('app.name', 'KIDD.MD') }}</title>
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

        {{-- Apply saved theme before paint to avoid a flash of the wrong mode. --}}
        <script>
            (function () {
                const t = localStorage.getItem('admin-theme');
                const dark = t ? t === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches;
                document.documentElement.classList.toggle('dark', dark);
            })();
        </script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            rel="preload"
            as="style"
            onload="this.rel = 'stylesheet'"
            href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400..700&family=Inter:wght@400..600&display=swap"
        />
        <noscript>
            <link
                rel="stylesheet"
                href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400..700&family=Inter:wght@400..600&display=swap"
            />
        </noscript>

        <!-- Scripts -->
        @vite(['resources/js/admin.js', 'resources/css/admin.css'])
        @livewireStyles
    </head>
    <body
        class="min-h-full bg-canvas text-ink"
        x-data="{ collapsed: JSON.parse(localStorage.getItem('admin-sidebar-collapsed') || 'false') }"
        x-init="$watch('collapsed', (v) => localStorage.setItem('admin-sidebar-collapsed', JSON.stringify(v)))"
    >
        <!-- Mobile sidebar -->
        @include('layouts.admin.sidebar_mobile')

        <!-- Static sidebar for desktop -->
        <div
            class="hidden transition-[width] duration-200 lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:flex-col"
            :class="collapsed ? 'lg:w-16' : 'lg:w-64'"
        >
            @include('layouts.admin.sidebar_desktop')
        </div>

        <div class="transition-[padding] duration-200" :class="collapsed ? 'lg:pl-16' : 'lg:pl-64'">
            <!-- Header -->
            @include('layouts.admin.header')

            <main class="py-6">
                <div class="mx-auto max-w-7xl space-y-5 px-4 sm:px-6 lg:px-8">
                    <x-admin.flash />
                    {{ $slot }}
                </div>
            </main>
        </div>

        @include('layouts.admin.command-palette')

        @livewireScripts
    </body>
</html>
