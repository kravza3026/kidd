
<x-app-layout>
    <div class="pageContent">
        <section class="py-section container grid lg:grid-cols-12 justify-between">
            <div class="pr-5 col-span-6">
                <h1 class="text-pretty text-2xl lg:text-[40px] pb-[40px]">
                    {!! __('careers.title') !!}
                </h1>
                <p class="text-pretty opacity-60 pb-[40px] leading-[150%] lg:leading-[175%]">
                    {{ __('careers.description') }}
                </p>

                <h2 class="font-bold text-3xl lg:text-2xl leading-[-2%]">
                    {{ __('careers.our_value_title') }}
                </h2>
                <div class="grid gap-y-2 lg:flex justify-between items-center gap-5 py-5 leading-[175%]">
                    <div class="flex items-center ">
                        <img width="40" height="40" class="pr-2" src={{ Vite::image('staticPages/careers/aboutIcon_1.png') }} alt="icon" alt="">
                        <p class="leading-[130%] font-normal">
                            {{ __('careers.our_values.quality') }}
                        </p>
                    </div>
                    <div class="flex items-center ">
                        <img width="40" height="40" class="pr-2" src={{ Vite::image('staticPages/careers/aboutIcon_2.png') }} alt="icon" alt="">
                        <p class="leading-[130%] font-normal">
                            {{ __('careers.our_values.materials') }}
                        </p>
                    </div>
                    <div class="flex items-center ">
                        <img width="40" height="40" class="pr-2" src={{ Vite::image('staticPages/careers/aboutIcon_3.png') }} alt="icon" alt="">
                        <p class="leading-[130%] font-normal">
                            {{ __('careers.our_values.price') }}
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-span-6 flex justify-center lg:justify-end">
                <div class="max-h-[650px] lg:mt-[-7%] h-full">
                    <img class="max-w-full mx-auto" height="650" alt="about" src={{ Vite::image('staticPages/careers/careers.png') }}>
                </div>
            </div>
        </section>

        <section class="py-section bg-light-orange">
            <div class="container lg:px-48">
                <h2 class="text-center opacity-80 text-3xl lg:text-[48px] font-bold leading-[175%]">
                    {{ __('careers.vacancies_listing_title') }}
                </h2>
                <p class="text-center leading-[175%] opacity-60 pb-10 text-sm lg:text-base">
                    {{ __('careers.vacancies_listing_description') }}
                </p>
                <div class="positions">
                    <hr class="border-light-border">
                    @foreach($vacancies as $vacancy)
                        <a href="{{ $vacancy->url }}" class="group grid lg:flex justify-between my-5 relative">
                            <div>
                                <p class="text-[20px] leading-[130%] font-medium">{{ $vacancy->title }}</p>
                                <p class="opacity-40 text-xs leading-[175%]">
                                    {{ __('careers.vacancies_latest_update', ['last_update' => $vacancy->updated_at->diffForHumans()]) }}
                                </p>
                                <div  class="text-olive flex items-center gap-x-2 mt-5">
                                    <span class="hidden lg:block">
                                        {{ __('careers.vacancies_details_button') }}
                                    </span>
                                    <span class="text-charcoal/20 group-hover:text-olive lg:text-olive absolute top-1 right-1 lg:top-0 lg:relative">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.73334 2.66666H12.6667C13.0349 2.66666 13.3333 2.96513 13.3333 3.33332V12.2667M2.66667 13.3333L12.8 3.19999"
                                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="lg:max-w-1/2 flex gap-x-2 flex-wrap">
                                @foreach($vacancy->tags as $tag)
                                    <span class="bg-white font-bold text-sm h-fit border-light-border border-1 py-2 px-3 rounded-full">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </a>
                        <hr class="border-light-border">
                    @endforeach
                </div>
            </div>
        </section>

    </div>
</x-app-layout>
