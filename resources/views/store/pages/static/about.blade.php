<x-app-layout>
    <div class="pageContent">
        <section class="py-section container grid justify-between lg:grid-cols-12">
            <div class="col-span-6 pr-5">
                <h1 class="pb-[40px] text-2xl leading-10 text-pretty lg:text-4xl lg:leading-[150%]">
                    {!! __('pages/about.title') !!}
                </h1>
                <p class="pb-[40px] leading-[150%] opacity-60 lg:leading-[175%]">
                    {!! __('pages/about.subtitle') !!}
                </p>

                <h2 class="text-[30px] leading-[-2%] font-bold lg:text-[24px]">
                    {{ __('pages/about.our_value_title') }}
                </h2>
                <div class="grid items-center justify-between gap-[20px] gap-y-2 py-[20px] leading-[175%] lg:flex">
                    <div class="flex items-center">
                        <img
                            width="40"
                            height="40"
                            class="pr-2"
                            src="{{ Vite::image('staticPages/about/aboutIcon_1.png') }}"
                            alt="icon"
                        />
                        <p class="leading-[130%] font-bold">
                            {{ __('pages/about.our_values.quality') }}
                        </p>
                    </div>
                    <div class="flex items-center">
                        <img
                            width="40"
                            height="40"
                            class="pr-2"
                            src="{{ Vite::image('staticPages/about/aboutIcon_2.png') }}"
                            alt="icon"
                        />
                        <p class="leading-[130%] font-bold">
                            {{ __('pages/about.our_values.materials') }}
                        </p>
                    </div>
                    <div class="flex items-center">
                        <img
                            width="40"
                            height="40"
                            class="pr-2"
                            src="{{ Vite::image('staticPages/about/aboutIcon_3.png') }}"
                            alt="icon"
                        />
                        <p class="leading-[130%] font-bold">
                            {{ __('pages/about.our_values.price') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-span-6 flex justify-center lg:justify-end">
                <div class="h-full max-h-[650px] lg:mt-[-7%]">
                    <img
                        class="mx-auto max-w-full"
                        height="650"
                        alt="about"
                        src="{{ Vite::image('staticPages/about/b_1.png') }}"
                    />
                </div>
            </div>
        </section>
        <section class="py-section bg-light-orange">
            <div class="container">
                <div class="grid gap-x-2 lg:grid-cols-2">
                    <h2 class="order-first text-[30px] font-bold lg:mb-[32px] lg:hidden">
                        {{ __('pages/about.who_we_are.title') }}
                    </h2>
                    <div class="order-last lg:order-none">
                        <h2 class="mb-[32px] hidden text-[48px] font-bold lg:block">
                            {{ __('pages/about.who_we_are.title') }}
                        </h2>
                        <p class="leading-[150%] opacity-80 lg:leading-[175%]">
                            {!! __('pages/about.who_we_are.content') !!}
                        </p>
                    </div>
                    <div class="order-1 flex justify-end py-5 lg:order-none lg:py-0">
                        <img
                            class="mx-auto max-w-full"
                            height="600"
                            alt="Who we are"
                            src="{{ Vite::image('staticPages/about/b_2.png') }}"
                        />
                    </div>
                </div>
                <div class="pt-section grid gap-x-2 lg:grid-cols-2">
                    <h2 class="order-first text-[30px] font-bold lg:mb-[32px] lg:hidden">
                        {{ __('pages/about.what_we_do.title') }}
                    </h2>
                    <div>
                        <h2 class="mb-[32px] hidden text-[48px] font-bold lg:block">
                            {{ __('pages/about.what_we_do.title') }}
                        </h2>
                        <p class="leading-[175%] opacity-80">
                            {!! __('pages/about.what_we_do.content') !!}
                        </p>
                    </div>
                    <div class="order-first flex justify-start py-5 lg:mt-[-10%] lg:py-0 xl:mt-[-25%]">
                        <img
                            class="mx-auto max-w-full"
                            width="500"
                            height="600"
                            alt="Who we are"
                            src="{{ Vite::image('staticPages/about/b_3.png') }}"
                        />
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
