@php
    $jobs = [
        [
            'title' => 'SEO Marketing Manager',
            'updated' => '2 days ago',
            'link' => '/',
            'tags' => ['Part-time', 'Remote'],
        ],
        [
            'title' => 'Frontend Developer',
            'updated' => '5 days ago',
            'link' => '/frontend',
            'tags' => ['Full-time', 'On-site'],
        ],
        [
            'title' => 'Content Writer',
            'updated' => '1 week ago',
            'link' => '/writer',
            'tags' => ['Freelance', 'Remote'],
        ],
        [
            'title' => 'Product Manager',
            'updated' => '3 days ago',
            'link' => '/product',
            'tags' => ['Full-time', 'Hybrid'],
        ],
        [
            'title' => 'UI/UX Designer',
            'updated' => '2 hours ago',
            'link' => '/designer',
            'tags' => ['Part-time', 'Remote'],
        ],
    ];
@endphp
<x-app-layout>
    <div class="pageContent ">
        <section class="py-section  container grid lg:grid-cols-12 justify-between">
            <div class="pr-5 col-span-6">
                <h1 class="text-[24px] lg:text-[40px] pb-[40px]">We are a team of passionate <span class="gradient_r-b">creators</span> and <span class="gradient_r-b">parents</span></h1>
                <p class="opacity-60 pb-[40px] leading-[150%] lg:leading-[175%]">
                    At KIDD. our mission is to provide stylish, high-quality baby clothing that combines comfort and functionality. We value sustainability, using eco-friendly materials, and prioritise ethical manufacturing practices. Our custom filtering feature helps you find  the perfect fit based on your child's weight, height, and age. We are committed to exceptional customer service, ensuring your satisfaction and your child's well-being. Join us as we celebrate the joy of parenthood, one outfit at a time.
                </p>

                <h2 class="font-bold text-[30px] lg:text-[24px] leading-[-2%]">Our values</h2>
                <div class="grid gap-y-2 lg:flex justify-between items-center gap-[20px] py-[20px] leading-[175%]">
                    <div class="flex items-center ">
                        <img width="40" height="40" class="pr-2" src={{ Vite::image('staticPages/about/aboutIcon_1.png') }} alt="icon" alt="">
                        <p class="leading-[130%] font-bold">High quality clothing
                            that is built to last</p>
                    </div>
                    <div class="flex items-center ">
                        <img width="40" height="40" class="pr-2" src={{ Vite::image('staticPages/about/aboutIcon_2.png') }} alt="icon" alt="">
                        <p class="leading-[130%] font-bold">Garments that feel
                            good on children skin</p>
                    </div>
                    <div class="flex items-center ">
                        <img width="40" height="40" class="pr-2" src={{ Vite::image('staticPages/about/aboutIcon_3.png') }} alt="icon" alt="">
                        <p class="leading-[130%] font-bold">Clothing that does
                            not break the bank</p>
                    </div>
                </div>

            </div>
            <div class="col-span-6 flex justify-center lg:justify-end">
                <div class="max-h-[650px] lg:mt-[-7%] h-full">
                    <img class="max-w-full mx-auto" height="650" alt="about" src={{ Vite::image('staticPages/about/b_1.png') }}>
                </div>
            </div>
        </section>
        <section class="py-section bg-light-orange">
            <div class="container px-48">
                <h2 class="text-center opacity-80 text-[48px] font-bold leading-[175%]">Do the work that matters</h2>
                <p class="text-center leading-[175%] opacity-60 pb-10">We are hiring now so please don’t hesitate to contact</p>
                <div class="positions">
                    <hr class="border-light-border">
                    @foreach($jobs as $job)
                        <div class="flex justify-between my-5">
                            <div>
                                <p class="text-[20px] leading-[130%] font-medium">{{ $job['title'] }}</p>
                                <p class="opacity-40 text-[12px] leading-[175%]">Last updated {{ $job['updated'] }}</p>
                                <a href="{{ $job['link'] }}" class="text-olive flex items-center gap-x-2 mt-5">
                                    Apply now
                                    <span>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.73334 2.66666H12.6667C13.0349 2.66666 13.3333 2.96513 13.3333 3.33332V12.2667M2.66667 13.3333L12.8 3.19999"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                                </a>
                            </div>
                            <div class="max-w-1/2 flex gap-x-2 flex-wrap">
                                @foreach($job['tags'] as $tag)
                                    <span class="bg-white font-bold text-[14px] h-fit border-light-border border-1 py-2 px-3 rounded-full">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                        @unless($loop->last)
                            <hr class="border-light-border">
                        @endunless
                    @endforeach
                    <hr class="border-light-border">
                </div>
            </div>
        </section>


    </div>
</x-app-layout>
