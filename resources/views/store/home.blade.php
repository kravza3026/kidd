<x-app-layout>
    <div class="pageContent">
        {{-- Hero Section --}}
        <section class="big-slider relative w-full h-[400px] md:h-[754px]"
                 style="background-image: url({{ Vite::image('home-page/bigBanner.jpg') }}); background-size: cover; background-position: center; background-repeat: no-repeat;"
        >
            <div class="absolute z-1 inset-0 grid place-items-end">
                <div class="container w-full text-white md:mb-16">
                    <h1 class="text-[30px] md:text-[64px] font-bold">
                        Discover adorable <br> outfits for your little joy!
                    </h1>
                    <p>
                        From cozy onesies to trendy outfits, we have everything you <br>
                        need to keep your baby stylish, comfortable and oh-so-cute
                    </p>
                    <div class="mt-5 md:mt-20">
                        <x-ui.button >Explore outfits</x-ui.button>
                    </div>
                </div>
            </div>
        </section>

        {{-- Repeat Section --}}
        <section class="container pt-section ">
            <div class="flex justify-between overflow-x-scroll md:overflow-hidden w-full gap-5">
                @for ($i = 1; $i <= 4; $i++)
                    <x-category-card
                        title="Jumpsuits"
                        background-image="{{ asset('assets/images/categories/category_' . $i . '.svg') }}"
                        link="/categories/jumpsuits"
                    />
                @endfor
            </div>
        </section>

        <section class="container pt-section ">
            <h2 class="section-title text-[30px] md:text-[48px] font-[700] pb-5">New arrivals</h2>
            <div class="py-5 font-[700] flex justify-between overflow-x-auto md:overflow-hidden">
                <ul class="flex gap-2 2xl:gap-6 cursor-pointer">
                    <x-ui.size-tag>Preemie</x-ui.size-tag>
                    <x-ui.size-tag>0-3M</x-ui.size-tag>
                    <x-ui.size-tag>3-6M</x-ui.size-tag>
                    <x-ui.size-tag>6-9M</x-ui.size-tag>
                    <x-ui.size-tag>9-12M</x-ui.size-tag>
                    <x-ui.size-tag>12-18M</x-ui.size-tag>
                    <x-ui.size-tag>18-24M</x-ui.size-tag>
                    <x-ui.size-tag>2Y</x-ui.size-tag>
                    <x-ui.size-tag>3-4Y</x-ui.size-tag>
                </ul>
                <a href="#" class="text-olive light_border px-4 py-2 bg-light-orange hover:bg-light-border animated flex items-center text-nowrap text-[14px]  mx-2">View all products</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 gap-x-3 gap-y-5 sm:gap-y-12 mt-5">
                {{-- Product cards --}}
                @foreach($products as $product)
                    <x-product-card :$product />
                @endforeach
            </div>
        </section>

        <section class="pt-section">
            <div class="grid grid-cols-1 md:flex items-center relative justify-start bg-olive  h-fit min-h-[380px] xl:min-h-[560px]">
                <div class="container order-2 md:order-1 pb-7 md:pb-0 relative h-full grid items-center content-center">
                    <div class="md:max-w-6/12">
                        <h2 class="section-title text-balance text-white md:text-[24px] xl:text-[40px] xl:leading-12 font-[700] py-5">
                            Subscribe to newsletter and get 25% off your first order
                        </h2>
                        <p class="text-white">
                            Receive the latest updates and take advantage of great offers
                        </p>
                        <form class="mt-10 ">
                            <div class="relative">
                                <input class="w-full focus:outline-hidden bg-white rounded-xl p-5" type="text" value="" placeholder="Your e-mail address">
                                <button class="absolute cursor-pointer right-2 top-2 text-white font-bold border-b-2 border-b-olive hover:bg-olive bg-charcoal rounded-xl py-3 px-7 animated">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
                <img class="md:absolute order-1 md:order-2 md:max-w-5/12 min-h-[380px] xl:min-h-[560px] right-0 top-0" src="{{ asset('assets/images/subscribe_bg.jpg') }}" alt="kidd">
            </div>
        </section>

        <section class="pt-section">
            <div class="container md:flex justify-between">
                <div class="w-full md:w-1/2 relative">
                    <img class="relative w-full rounded-2xl md:rounded-l-2xl md:rounded-r-none right-0 top-0" src="{{ asset('assets/images/gender_1.jpg') }}" alt="">
                    <div class="absolute inset-0 grid items-end">
                        <div class="rounded-2xl md:rounded-l-2xl md:rounded-r-none bg-gradient-to-t from-gray-900/10 to-slate-50/0 w-full mx-auto md:px-10  p-4 bg-opacity-60">
                            <h3 class="text-white text-[24px] md:text-[40px] font-bold">Sweets for little princesses</h3>
                            <p class="text-white text-base">Discover a variety of vibrant colours, playful patterns, and trendy
                                designs that will make your baby girl shine.</p>
                            <x-ui.button >Shop now</x-ui.button>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 relative mt-7 md:mt-0">
                    <img class="relative w-full  rounded-2xl md:rounded-r-2xl md:rounded-l-none right-0 top-0" src="{{ asset('assets/images/gender_2.jpg') }}" alt="">
                    <div class="absolute inset-0 grid items-end">
                        <div class="rounded-2xl md:rounded-r-2xl md:rounded-l-none bg-gradient-to-t from-gray-900/10 to-slate-50/0 w-full px-10 mx-auto  p-4 bg-opacity-60">
                            <h3 class="text-white text-[24px] md:text-[40px] font-bold">Adorable style for little men</h3>
                            <p class="text-white text-base">Shop our selection of durable and high-quality clothing, designed to  keep up with your baby boy's active lifestyle.</p>
                            <x-ui.button >Shop now</x-ui.button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</x-app-layout>
