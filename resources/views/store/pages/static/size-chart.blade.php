<x-app-layout>
    <div class="pageContent  max-w-3xl mx-auto py-section">
{{--        {{ app()->getLocale() }}--}}
            <div class="lg:flex justify-between items-center">
                <div class="px-2 lg:px-0 pb-4 lg:pb-0 text-3xl lg:text-5xl font-bold flex items-center gap-x-2 mb-4 lg:mb-0 border-b lg:border-none border-b-light-border">
                    <h1>Size guide</h1>
                </div>
                <div class="flex items-center gap-x-2 px-2 lg:px-0">
                    <a class="hover:bg-olive border border-light-border px-5 py-2 hover:text-white uppercase rounded-full text-sm" href="#">en</a>
                    <a class="hover:bg-olive border border-light-border px-5 py-2 hover:text-white uppercase rounded-full text-sm" href="#">uk</a>
                    <a class="hover:bg-olive border border-light-border px-5 py-2 hover:text-white uppercase rounded-full text-sm" href="#">us</a>
                </div>
            </div>
        <div class="mt-5 lg:mt-10 ">
            <div class="border lg:my-1 bg-white border-light-border lg:rounded-2xl">
                <input id="jumpsuits" checked type="checkbox" class="peer hidden">
                <label for="jumpsuits"
                       class="head flex justify-between items-center lg:rounded-2xl peer-checked:peer-checked:!rounded-b-none px-4 py-2 bg-light-orange duration-300 peer-checked:[&_.accordion-arrow]:rotate-180">
                    <span class="flex items-center gap-x-2 p-2">
                        <img src="{{Vite::image('icons/categories/jumpsuits.svg')}}" alt="">
                        <span class="font-bold text-lg lg:text-xl">Jumpsuits</span>
                    </span>
                    <span class="border border-light-border bg-white flex items-center justify-center rounded-full w-10 h-10">
                        <img class="accordion-arrow duration-300" src="{{ Vite::image('icons/top_arrow.svg') }}" alt="">
                    </span>
                </label>
                <div class="content px-4 py-0 peer-checked:scale-y-100 scale-y-0 peer-checked:h-fit h-0">
                    <div class="grid grid-cols-12 gap-x-2 pt-4">
                        <p class="px-2 opacity-40 text-[10px] uppercase font-bold col-span-3 lg:col-span-4 ">Size</p>
                        <p class="px-2 opacity-40 text-[10px] uppercase font-bold col-span-4 ">Height</p>
                        <p class="px-2 opacity-40 text-[10px] uppercase font-bold col-span-5 lg:col-span-4 ">Weight</p>

                    </div>
                    <hr class="my-4 border-light-border">
                    <div class="pb-2">
                        <div class="grid grid-cols-12 gap-x-2 mt-2 h-10 rounded-2xl hover:bg-light-orange duration-300">
                            <p class=" px-2 cursor-pointer text-xs font-bold col-span-3 lg:col-span-4 flex items-center">Preemie</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-4 flex items-center">< 55 cm</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-5 lg:col-span-4 flex items-center">up to 2.7 kg</p>

                        </div>
                        <div class="grid grid-cols-12 gap-x-2 mt-2 h-10 rounded-2xl hover:bg-light-orange duration-300">
                            <p class=" px-2 cursor-pointer text-xs font-bold col-span-3 lg:col-span-4 flex items-center">Newborn</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-4 flex items-center">< 56 – 62 cm</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-5 lg:col-span-4 flex justify-between items-center">4 kg — 5.7 kg
                                <span>

<svg width="28" height="29" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="28" height="28" rx="14" fill="#EAC2C3"/>
<g filter="url(#filter0_d_1131_15737)">
<path d="M17.8137 9.088V10.894H12.7597V13.204H17.1697V15.01H12.7597V17.208H17.8137V19H10.7297V9.088H17.8137Z" fill="white"/>
</g>
<defs>
<filter id="filter0_d_1131_15737" x="4.72656" y="3.088" width="23.0859" height="25.912" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
<feOffset dx="2" dy="2"/>
<feGaussianBlur stdDeviation="4"/>
<feComposite in2="hardAlpha" operator="out"/>
<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"/>
<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1131_15737"/>
<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1131_15737" result="shape"/>
</filter>
</defs>
</svg>

                                </span>
                            </p>
                        </div>
                        <div class="grid grid-cols-12 gap-x-2 mt-2 h-10 rounded-2xl hover:bg-light-orange duration-300">
                            <p class=" px-2 cursor-pointer text-xs font-bold col-span-3 lg:col-span-4 flex items-center">3–6M</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-4 flex items-center">62 – 68 cm</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-5 lg:col-span-4 flex justify-between items-center">5.7 kg — 7.5 kg</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="border lg:my-1 bg-white border-light-border lg:rounded-2xl">
                <input id="jackets" type="checkbox" class="peer hidden">
                <label for="jackets"
                       class="head flex justify-between items-center lg:rounded-2xl peer-checked:peer-checked:!rounded-b-none px-4 py-2 bg-light-orange duration-300 peer-checked:[&_.accordion-arrow]:rotate-180">
                    <span class="flex items-center gap-x-2 p-2">
                        <img src="{{Vite::image('icons/categories/jackets.svg')}}" alt="">
                        <span class="font-bold text-lg lg:text-xl">Jackets</span>
                    </span>
                    <span class="border border-light-border bg-white flex items-center justify-center rounded-full w-10 h-10">
                        <img class="accordion-arrow duration-300" src="{{ Vite::image('icons/top_arrow.svg') }}" alt="">
                    </span>
                </label>
                <div class="content px-4 py-0 peer-checked:scale-y-100 scale-y-0 peer-checked:h-fit h-0">
                    <div class="grid grid-cols-12 gap-x-2 pt-4">
                        <p class="px-2 opacity-40 text-[10px] uppercase font-bold col-span-3 lg:col-span-4 ">Size</p>
                        <p class="px-2 opacity-40 text-[10px] uppercase font-bold col-span-4 ">Height</p>
                        <p class="px-2 opacity-40 text-[10px] uppercase font-bold col-span-5 lg:col-span-4 ">Weight</p>

                    </div>
                    <hr class="my-4 border-light-border">
                    <div class="pb-2">
                        <div class="grid grid-cols-12 gap-x-2 mt-2 h-10 rounded-2xl hover:bg-light-orange duration-300">
                            <p class=" px-2 cursor-pointer text-xs font-bold col-span-3 lg:col-span-4 flex items-center">Preemie</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-4 flex items-center">< 55 cm</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-5 lg:col-span-4 flex items-center">up to 2.7 kg</p>

                        </div>
                        <div class="grid grid-cols-12 gap-x-2 mt-2 h-10 rounded-2xl hover:bg-light-orange duration-300">
                            <p class=" px-2 cursor-pointer text-xs font-bold col-span-3 lg:col-span-4 flex items-center">Newborn</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-4 flex items-center">< 56 – 62 cm</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-5 lg:col-span-4 flex justify-between items-center">4 kg — 5.7 kg
                                <span>

<svg width="28" height="29" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="28" height="28" rx="14" fill="#EAC2C3"/>
<g filter="url(#filter0_d_1131_15737)">
<path d="M17.8137 9.088V10.894H12.7597V13.204H17.1697V15.01H12.7597V17.208H17.8137V19H10.7297V9.088H17.8137Z" fill="white"/>
</g>
<defs>
<filter id="filter0_d_1131_15737" x="4.72656" y="3.088" width="23.0859" height="25.912" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
<feOffset dx="2" dy="2"/>
<feGaussianBlur stdDeviation="4"/>
<feComposite in2="hardAlpha" operator="out"/>
<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"/>
<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1131_15737"/>
<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1131_15737" result="shape"/>
</filter>
</defs>
</svg>

                                </span>
                            </p>
                        </div>
                        <div class="grid grid-cols-12 gap-x-2 mt-2 h-10 rounded-2xl hover:bg-light-orange duration-300">
                            <p class=" px-2 cursor-pointer text-xs font-bold col-span-3 lg:col-span-4 flex items-center">3–6M</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-4 flex items-center">62 – 68 cm</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-5 lg:col-span-4 flex justify-between items-center">5.7 kg — 7.5 kg</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="border lg:my-1 bg-white border-light-border lg:rounded-2xl">
                <input id="bodysuits" type="checkbox" class="peer hidden">
                <label for="bodysuits"
                       class="head flex justify-between items-center lg:rounded-2xl peer-checked:peer-checked:!rounded-b-none px-4 py-2 bg-light-orange duration-300 peer-checked:[&_.accordion-arrow]:rotate-180">
                    <span class="flex items-center gap-x-2 p-2">
                        <img src="{{Vite::image('icons/categories/bodysuits.svg')}}" alt="">
                        <span class="font-bold text-lg lg:text-xl">Bodysuits</span>
                    </span>
                    <span class="border border-light-border bg-white flex items-center justify-center rounded-full w-10 h-10">
                        <img class="accordion-arrow duration-300" src="{{ Vite::image('icons/top_arrow.svg') }}" alt="">
                    </span>
                </label>
                <div class="content px-4 py-0 peer-checked:scale-y-100 scale-y-0 peer-checked:h-fit h-0">
                    <div class="grid grid-cols-12 gap-x-2 pt-4">
                        <p class="px-2 opacity-40 text-[10px] uppercase font-bold col-span-3 lg:col-span-4 ">Size</p>
                        <p class="px-2 opacity-40 text-[10px] uppercase font-bold col-span-4 ">Height</p>
                        <p class="px-2 opacity-40 text-[10px] uppercase font-bold col-span-5 lg:col-span-4 ">Weight</p>

                    </div>
                    <hr class="my-4 border-light-border">
                    <div class="pb-2">
                        <div class="grid grid-cols-12 gap-x-2 mt-2 h-10 rounded-2xl hover:bg-light-orange duration-300">
                            <p class=" px-2 cursor-pointer text-xs font-bold col-span-3 lg:col-span-4 flex items-center">Preemie</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-4 flex items-center">< 55 cm</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-5 lg:col-span-4 flex items-center">up to 2.7 kg</p>

                        </div>
                        <div class="grid grid-cols-12 gap-x-2 mt-2 h-10 rounded-2xl hover:bg-light-orange duration-300">
                            <p class=" px-2 cursor-pointer text-xs font-bold col-span-3 lg:col-span-4 flex items-center">Newborn</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-4 flex items-center">< 56 – 62 cm</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-5 lg:col-span-4 flex justify-between items-center">4 kg — 5.7 kg
                                <span>

<svg width="28" height="29" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="28" height="28" rx="14" fill="#EAC2C3"/>
<g filter="url(#filter0_d_1131_15737)">
<path d="M17.8137 9.088V10.894H12.7597V13.204H17.1697V15.01H12.7597V17.208H17.8137V19H10.7297V9.088H17.8137Z" fill="white"/>
</g>
<defs>
<filter id="filter0_d_1131_15737" x="4.72656" y="3.088" width="23.0859" height="25.912" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
<feOffset dx="2" dy="2"/>
<feGaussianBlur stdDeviation="4"/>
<feComposite in2="hardAlpha" operator="out"/>
<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"/>
<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1131_15737"/>
<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1131_15737" result="shape"/>
</filter>
</defs>
</svg>

                                </span>
                            </p>
                        </div>
                        <div class="grid grid-cols-12 gap-x-2 mt-2 h-10 rounded-2xl hover:bg-light-orange duration-300">
                            <p class=" px-2 cursor-pointer text-xs font-bold col-span-3 lg:col-span-4 flex items-center">3–6M</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-4 flex items-center">62 – 68 cm</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-5 lg:col-span-4 flex justify-between items-center">5.7 kg — 7.5 kg</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="border lg:my-1 bg-white border-light-border lg:rounded-2xl">
                <input id="pants" type="checkbox" class="peer hidden">
                <label for="pants"
                       class="head flex justify-between items-center lg:rounded-2xl peer-checked:peer-checked:!rounded-b-none px-4 py-2 bg-light-orange duration-300 peer-checked:[&_.accordion-arrow]:rotate-180">
                    <span class="flex items-center gap-x-2 p-2">
                        <img src="{{Vite::image('icons/categories/pants.svg')}}" alt="">
                        <span class="font-bold text-lg lg:text-xl">Pants</span>
                    </span>
                    <span class="border border-light-border bg-white flex items-center justify-center rounded-full w-10 h-10">
                        <img class="accordion-arrow duration-300" src="{{ Vite::image('icons/top_arrow.svg') }}" alt="">
                    </span>
                </label>
                <div class="content px-4 py-0 peer-checked:scale-y-100 scale-y-0 peer-checked:h-fit h-0">
                    <div class="grid grid-cols-12 gap-x-2 pt-4">
                        <p class="px-2 opacity-40 text-[10px] uppercase font-bold col-span-3 lg:col-span-4 ">Size</p>
                        <p class="px-2 opacity-40 text-[10px] uppercase font-bold col-span-4 ">Height</p>
                        <p class="px-2 opacity-40 text-[10px] uppercase font-bold col-span-5 lg:col-span-4 ">Weight</p>

                    </div>
                    <hr class="my-4 border-light-border">
                    <div class="pb-2">
                        <div class="grid grid-cols-12 gap-x-2 mt-2 h-10 rounded-2xl hover:bg-light-orange duration-300">
                            <p class=" px-2 cursor-pointer text-xs font-bold col-span-3 lg:col-span-4 flex items-center">Preemie</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-4 flex items-center">< 55 cm</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-5 lg:col-span-4 flex items-center">up to 2.7 kg</p>

                        </div>
                        <div class="grid grid-cols-12 gap-x-2 mt-2 h-10 rounded-2xl hover:bg-light-orange duration-300">
                            <p class=" px-2 cursor-pointer text-xs font-bold col-span-3 lg:col-span-4 flex items-center">Newborn</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-4 flex items-center">< 56 – 62 cm</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-5 lg:col-span-4 flex justify-between items-center">4 kg — 5.7 kg
                                <span>

<svg width="28" height="29" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="28" height="28" rx="14" fill="#EAC2C3"/>
<g filter="url(#filter0_d_1131_15737)">
<path d="M17.8137 9.088V10.894H12.7597V13.204H17.1697V15.01H12.7597V17.208H17.8137V19H10.7297V9.088H17.8137Z" fill="white"/>
</g>
<defs>
<filter id="filter0_d_1131_15737" x="4.72656" y="3.088" width="23.0859" height="25.912" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
<feOffset dx="2" dy="2"/>
<feGaussianBlur stdDeviation="4"/>
<feComposite in2="hardAlpha" operator="out"/>
<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"/>
<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1131_15737"/>
<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1131_15737" result="shape"/>
</filter>
</defs>
</svg>

                                </span>
                            </p>
                        </div>
                        <div class="grid grid-cols-12 gap-x-2 mt-2 h-10 rounded-2xl hover:bg-light-orange duration-300">
                            <p class=" px-2 cursor-pointer text-xs font-bold col-span-3 lg:col-span-4 flex items-center">3–6M</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-4 flex items-center">62 – 68 cm</p>
                            <p class=" px-2 cursor-pointer text-xs col-span-5 lg:col-span-4 flex justify-between items-center">5.7 kg — 7.5 kg</p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
