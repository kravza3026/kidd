<div class="pageContent">
    {{-- Hero Section --}}
    <section class="big-slider relative w-full">
        <img src="{{ Vite::asset('resources/images/home-page/bigBanner.jpg') }}" alt="banner" class="w-full">
        <div class="absolute z-1 inset-0 grid place-items-end">
            <div class="container w-full text-white ">
                <h1 class="text-[64px] font-bold">
                    Discover adorable <br> outfits for your little joy!
                </h1>
                <p>
                    From cozy onesies to trendy outfits, we have everything you <br>
                    need to keep your baby stylish, comfortable and oh-so-cute
                </p>
                <x-button>Explore outfits</x-button>
            </div>
        </div>
    </section>

    {{-- Repeat Section --}}
    <section class="container py-10 mt-10 flex justify-between gap-5">
        @for ($i = 1; $i <= 4; $i++)
            <x-category-card
                title="Jumpsuits"
                background-image="{{ asset('assets/images/categories/category_' . $i . '.svg') }}"
                link="/categories/jumpsuits"
            />
        @endfor

    </section>

    <section class="container py-10 ">
        <h2 class="section-title text-[48px] font-[700] py-5">New arrivals</h2>
        <div class="p-5 font-[700] flex justify-between">
            <ul class="flex gap-16">
                <li>Preemie</li>
                <li>0-3M</li>
                <li>3-6M</li>
                <li>6-9M</li>
                <li>9-12M</li>
                <li>12-18M</li>
                <li>18-24M</li>
                <li>2Y</li>
                <li>3-4Y</li>
            </ul>
            <p class="text-olive text-[14px]">View all products</p>
        </div>
        <div class="flex justify-between gap-2">
            @for ($i = 1; $i <= 3; $i++)
                <x-product-card
                    title="Unisex Cotton Jumpsuit"
                    price="265"
                    image="{{ asset('assets/images/products/product_' . $i . '.png') }}"
                    :is-new="true"
                    gender-icon="{{ asset('assets/images/icons/unisex.svg') }}"
                    age-label="0-12M"
                    :colors="['#c5bfb4', '#f7e5e2', '#e5e8e0']"

                />

            @endfor
                <x-product-card
                    title="Summer Cotton Jumpsuit"
                    price="240"
                    oldPrice="300"
                    discount="20%"
                    image="{{ asset('assets/images/products/product_4.png') }}"
                    :is-new="true"
                    gender-icon="{{ asset('assets/images/icons/unisex.svg') }}"
                    age-label="0-12M"
                    :colors="['#c5bfb4', '#f7e5e2']"

                />
        </div>
    </section>
    <section>
        <div class="flex items-center relative justify-between bg-olive  h-fit">
            <div class="w-4/7 pl-[80px] relative h-full grid items-center content-center">
                <h2 class="section-title text-white text-[40px] font-[700] px-15 py-5">Subscribe to newsletter and get 25% off your first order</h2>
                <p class="text-white px-15">
                    Receive the latest updates and take advantage of great offers
                </p>
                <form class="mt-10 w-11/12 px-15">
                    <div class="relative">
                        <input class="w-full bg-white rounded-xl p-5" type="text" value="" placeholder="Your e-mail address">
                        <button class="absolute cursor-pointer right-1 top-2 text-white font-bold border-b-2 border-b-olive hover:bg-olive bg-charcoal rounded-xl py-3 px-7 duration-700">Subscribe</button>
                    </div>
                </form>
            </div>
            <img class="relative right-0 top-0" src="{{ asset('assets/images/subscribe_bg.jpg') }}" alt="">
        </div>

    </section>
</div>
