<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
            @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>

    <body>
        <x-layout.header />
       <main class="bg-white">
           <x-layout.home-page />
       </main>
        <x-layout.footer />
        <div  data-vue-component="mobileMenu"></div>


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
