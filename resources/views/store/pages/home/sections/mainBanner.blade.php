<section class="big-slider relative w-full h-[400px] md:h-[754px]"
         style="background-image: url({{ Vite::image('home-page/bigBanner.jpg') }}); background-size: cover; background-position: center; background-repeat: no-repeat;"
>
    <div class="absolute z-1 inset-0 grid place-items-end">
        <div class="container w-full text-white md:mb-16 xl:pr-[25%]">
            <h1 class="text-balance text-[1.8rem] md:text-[64px] font-bold -tracking-[2%] leading-[130%]">
                Discover adorable outfits for your little joy!
            </h1>
            <p class="mt-2 text-pretty xl:text-balance text-sm md:text-lg font-normal -tracking-[2%] leading-[175%]">
                From cozy onesies to trendy outfits, we have everything you need to keep your baby stylish, comfortable and oh-so-cute
            </p>
            <div class="mt-5 md:mt-20">
                <x-ui.button as="a" href="{{ route('products.index') }}" size="large"  class="my-5">Explore outfits</x-ui.button>

            </div>
        </div>
    </div>
</section>
