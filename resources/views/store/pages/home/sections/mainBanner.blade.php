<section
    class="big-slider relative h-[400px] w-full md:h-[754px]"
    style="
        background-image: url({{ Vite::image('home-page/bigBanner.jpg') }});
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    "
>
    <div class="absolute inset-0 z-1 grid place-items-end">
        <div class="container w-full text-white md:mb-16 xl:pr-[25%]">
            <h1 class="text-[1.8rem] leading-[130%] font-bold -tracking-[2%] text-balance md:text-[64px]">
                {{ __('main.banner.title') }}
            </h1>
            <p class="mt-2 text-sm leading-[175%] font-normal -tracking-[2%] text-pretty md:text-lg xl:text-balance">
                {{ __('main.banner.subtitle') }}
            </p>
            <div class="mt-5 md:mt-20">
                <x-ui.button as="a" href="{{ route('products.index') }}" size="large" class="my-5">
                    {{ __('main.banner.explore_btn') }}
                </x-ui.button>
            </div>
        </div>
    </div>
</section>
