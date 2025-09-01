<section class="pt-section pb-section">
    <div class="container justify-between md:flex">
        <div class="relative w-full md:w-1/2">
            <img
                class="relative top-0 right-0 w-full rounded-2xl md:rounded-l-2xl md:rounded-r-none"
                src="{{ Vite::image('gender_1.jpg') }}"
                alt=""
            />
            <div class="absolute inset-0 grid items-end">
                <div
                    class="bg-opacity-60 mx-auto w-full rounded-2xl bg-gradient-to-t from-gray-900/10 to-slate-50/0 p-4 pb-0 text-pretty md:rounded-l-2xl md:rounded-r-none md:px-8 md:pb-6 xl:px-16 xl:pb-12"
                >
                    <h3 class="text-snow text-2xl leading-[130%] font-bold -tracking-[2%] lg:text-[40px]">
                        {{ __('main.split_actions.girls.title') }}
                    </h3>
                    <p class="text-snow text-sm md:text-base lg:leading-[175%]">
                        {{ __('main.split_actions.girls.description') }}
                    </p>
                    <x-ui.button
                        as="a"
                        href="{{ route('products.index', ['filters[gender]' => [\App\Models\Gender::UNISEX => true, \App\Models\Gender::GIRL => true] ]) }}"
                        class="my-5"
                    >
                        {{ __('main.split_actions.shop_btn') }}
                    </x-ui.button>
                </div>
            </div>
        </div>
        <div class="relative mt-7 w-full md:mt-0 md:w-1/2">
            <img
                class="relative top-0 right-0 w-full rounded-2xl md:rounded-l-none md:rounded-r-2xl"
                src="{{ Vite::image('gender_2.jpg') }}"
                alt=""
            />
            <div class="absolute inset-0 grid items-end">
                <div
                    class="bg-opacity-60 mx-auto w-full rounded-2xl bg-gradient-to-t from-gray-900/10 to-slate-50/0 p-4 pb-0 text-pretty md:rounded-l-none md:rounded-r-2xl md:px-8 md:pb-6 xl:px-16 xl:pb-12"
                >
                    <h3 class="text-snow text-2xl leading-[130%] font-bold -tracking-[2%] lg:text-[40px]">
                        {{ __('main.split_actions.boys.title') }}
                    </h3>
                    <p class="text-snow text-sm md:text-base lg:leading-[175%]">
                        {{ __('main.split_actions.boys.description') }}
                    </p>
                    <x-ui.button
                        as="a"
                        href="{{ route('products.index', ['filters[gender]' => [\App\Models\Gender::UNISEX => true, \App\Models\Gender::BOY => true] ]) }}"
                        class="my-5"
                    >
                        {{ __('main.split_actions.shop_btn') }}
                    </x-ui.button>
                </div>
            </div>
        </div>
    </div>
</section>
