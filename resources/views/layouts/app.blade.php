<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="overflow-x-hidden"
    hx-headers='{"Accept-Language": "{{ str_replace(' ', '-', app()->getLocale()) }}"}'>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <meta
            name="description"
            content="{{ __('seo.general.description') }}"
        />

        <title>{{ __('seo.general.title') }}</title>

        @include('layouts.partials.schema.organization')
        @stack('meta')

        <!-- Favicons -->
        <link rel="icon" type="image/x-icon" sizes="32x32" href="{{ Vite::image('favicon.png') }}" />
        <link rel="icon" type="image/x-icon" sizes="16x16" href="{{ Vite::image('favicon.png') }}" />
        <link rel="icon" type="image/x-icon" href="{{ Vite::image('favicon.png') }}" />

        @include('layouts.partials.seo')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin />
        <link
            rel="preload"
            as="style"
            onload="this.rel = 'stylesheet'"
            href="https://fonts.googleapis.com/css2?family=Onest:wght@300..700&display=swap"
        />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @cookieconsentscripts
        @stack('head')
        @include('layouts.partials.analytics')
    </head>
    <body @class(['page-fade', 'bg-white','overflow-x-hidden', '!bg-[#FAFAFA]' => request()->is('*/account/*')]) >
        <div id="app">
            @include('layouts.partials.header')

            <main class="min-h-[calc(100vh-250px)] pb-22.5 lg:pb-0">
                {{ $slot }}
            </main>

            <div class="fixed bottom-0 left-0 z-1000 w-full bg-white lg:hidden">
                <mobile-menu
                    :user="{{ json_encode(auth()->user()) }}"
                    :is-authenticated="{{ json_encode(auth()->check()) }}"
                    help-url="{{ url(LaravelLocalization::getCurrentLocale() . '/' . trans('routes.menu.help', [], LaravelLocalization::getCurrentLocale())) }}"
                ></mobile-menu>
            </div>

            <scroll-to-top></scroll-to-top>
        </div>

        @include('layouts.partials.footer')


        @cookieconsentview
        @stack('scripts')

        @if (session()->has('toast') || session()->has('modal'))
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    @if(session('toast'))
                        window.toast(@json(session('toast')));
                    @endif
                    @if(session('modal'))
                        Swal.fire({
                            imageUrl: '{{ isset(session('modal')['image']['url']) ? session('modal')['image']['url'] : Vite::image('icons/olive/file.png') }}',
                            imageWidth: 200,
                            imageHeight: 200,
                            imageAlt: '{{ isset(session('modal')['image']['alt']) ? session('modal')['image']['alt'] : __('general.modal.img_alt-generic') }}',
                            showCloseButton: true,
                            showConfirmButton: false,
                            didOpen: () => {
                                document.getElementById('close-alert').addEventListener('click', () => {
                                    Swal.close();
                                });
                            },
                            customClass: {
                                popup: 'bg-white shadow-xl !rounded-lg !p-4',
                                title: 'text-xl font-bold text-green-700',
                                htmlContainer: 'text-gray-600 ',
                            },
                            html: `{!! str_replace("\n", '', trim(view('partials.modals.modal')->render())) !!}`
                        });
                    @endif
                });
            </script>
        @endif
    </body>
</html>
