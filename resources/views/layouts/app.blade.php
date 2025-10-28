<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <meta
            name="description"
            content="Discover adorable outfits for your little joy! From cozy onesies to trendy outfits, we have everything you need to keep your baby stylish, comfortable and oh-so-cute."
        />

        <title>{{ config('app.name') }} - Moldova</title>

        @stack('meta')

        <!-- Favicons -->
        <link rel="icon" type="image/x-icon" sizes="32x32" href="{{ Vite::image('common/favicon_32x32.ico') }}" />
        <link rel="icon" type="image/x-icon" sizes="16x16" href="{{ Vite::image('common/favicon_16x16.ico') }}" />
        <link rel="icon" type="image/x-icon" href="{{ Vite::image('favicon.png') }}" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin />
        <link
            rel="preload"
            as="style"
            onload="this.rel='stylesheet'"
            href="https://fonts.googleapis.com/css2?family=Onest:wght@300..700&display=swap"
        />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @cookieconsentscripts
        @stack('head')
        @include('layouts.partials.analytics')
    </head>
    <body @class(['page-fade', 'bg-white', 'min-h-[calc(100vh-250px)]', '!bg-[#FAFAFA]' => request()->is('*/account/*')])>


            @include('layouts.partials.header')

           <main>
               {{ $slot }}
           </main>

            @include('layouts.partials.footer')
            <div
                class="fixed bottom-0 left-0 right-0 z-[1000] bg-white"
                data-vue-component="mobileMenu"
                data-vue-props="{{ json_encode(['user' => auth()->user(), 'isAuthenticated' => auth()->check()]) }}"
            ></div>




        <div data-vue-component="ScrollToTop"></div>
        <div
            class="backdrop fixed inset-0 z-[2] bg-black/70"
            x-data
            x-cloak
            x-show="$store.dropdown.open"
            x-transition:enter="transition duration-200 ease-out"
            x-transition:enter-start="opacity-0 scale-95 "
            x-transition:enter-end="opacity-100 "
        ></div>

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
                            imageUrl: '{{ isset(session('modal')['image']['url']) ? session('modal')['image']['url'] : Vite::image('icons/file.png') }}',
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
                            html: `{!! str_replace("\n", '', trim(view('partials.modals.modal')->render())) !!}`,

                        });
                    @endif
                });
            </script>
        @endif

        {{-- Pixel NoScript Start --}}
        <noscript>
            <img
                height="1"
                width="1"
                style="display: none"
                src="https://www.facebook.com/tr?id=2308317899361524&ev=PageView&noscript=1"
            />
        </noscript>
        {{-- Pixel NoScript End --}}
    </body>
</html>
