<footer class="bg-charcoal mt-7 py-10">

    <div class="container ">
        <div class="grid grid-cols-1 xl:flex xl:justify-between space-y-2">
            <div
                class="order-last xl:order-first group flex justify-between xl:justify-start xl:flex-col items-center xl:items-start gap-2 bg-black p-5 text-white"
                tabindex="1"
            >
                <div class="flex cursor-pointer items-center justify-between">
                    <h5 class="text-white opacity-60  font-bold">Follow us on</h5>
                </div>
                <div>
                    <ul class="flex items-center gap-4 xl:mt-7">
                        <li>
                            <a href="#">
                                <img src="{{ asset('assets/images/icons/socials/facebook.svg') }}" alt="">

                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="{{ asset('assets/images/icons/socials/ln.svg') }}" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="{{ asset('assets/images/icons/socials/youtube_i.svg') }}" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="{{ asset('assets/images/icons/socials/messenger.svg') }}" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div
                class="group flex flex-col gap-2 rounded-lg bg-black p-5 text-white"
                tabindex="1"
            >
                <div class="flex cursor-pointer items-center justify-between">
                    <h5 class="text-white opacity-60 group-focus:opacity-100 font-bold">Catalog</h5>
                    <img
                        class="w-3 transition-all xl:invisible duration-500 group-focus:-rotate-180"
                        src="{{ asset('assets/images/icons/accordion_arrow.png') }}" alt="">
                </div>
                <div
                    class="invisible xl:visible h-auto max-h-0 xl:max-h-screen items-center opacity-0 xl:opacity-100 transition-all group-focus:visible group-focus:max-h-screen group-focus:opacity-100 group-focus:duration-1000"
                >

                    <ul class="text-white mt-5">
                        <li class="opacity-25 py-2"><a href="#">Jumpsuits</a></li>
                        <li class="opacity-25 py-2"><a href="#">Jackets</a></li>
                        <li class="opacity-25 py-2"><a href="#">Bodysuits</a></li>
                        <li class="opacity-25 py-2"><a href="#">Pants</a></li>
                        <li class="opacity-25 py-2"><a href="#">Sets</a></li>
                    </ul>
                </div>
            </div>
            <div
                class="group flex flex-col gap-2 rounded-lg bg-black p-5 text-white"
                tabindex="1"
            >
                <div class="flex cursor-pointer items-center justify-between">
                    <h5 class="text-white opacity-60 group-focus:opacity-100 font-bold">Help</h5>
                    <img
                        class="w-3 transition-all xl:invisible duration-500 group-focus:-rotate-180"
                        src="{{ asset('assets/images/icons/accordion_arrow.png') }}" alt="">
                </div>
                <div
                    class="invisible xl:visible h-auto max-h-0 xl:max-h-screen items-center opacity-0 xl:opacity-100 transition-all group-focus:visible group-focus:max-h-screen group-focus:opacity-100 group-focus:duration-1000"
                >
                    <ul class="text-white mt-5">
                        <li class="opacity-25 py-2"><a href="#">Frequent questions</a></li>
                        <li class="opacity-25 py-2"><a href="#">Size chart</a></li>
                        <li class="opacity-25 py-2"><a href="#">Return Policy</a></li>
                        <li class="opacity-25 py-2"><a href="#">Delivery info</a></li>
                        <li class="opacity-25 py-2"><a href="#">Contact us</a></li>
                    </ul>
                </div>
            </div>
            <div
                class="group flex flex-col gap-2 rounded-lg bg-black p-5 text-white"
                tabindex="1"
            >
                <div class="flex cursor-pointer items-center justify-between">
                    <h5 class="text-white opacity-60 group-focus:opacity-100 font-bold">Company</h5>
                    <img
                        class="w-3 transition-all xl:invisible duration-500 group-focus:-rotate-180"
                        src="{{ asset('assets/images/icons/accordion_arrow.png') }}" alt="">
                </div>
                <div
                    class="invisible xl:visible h-auto max-h-0 xl:max-h-screen items-center opacity-0 xl:opacity-100 transition-all group-focus:visible group-focus:max-h-screen group-focus:opacity-100 group-focus:duration-1000"
                >
                    <ul class="text-white mt-5">
                        <li class="opacity-25 py-2"><a href="#">About us</a></li>
                        <li class="opacity-25 py-2"><a href="#">Store locations</a></li>
                        <li class="opacity-25 py-2"><a href="#">Careers</a></li>
                        <li class="opacity-25 py-2"><a href="#">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>
            <div
                class="group flex flex-col gap-2 rounded-lg bg-black xl:min-w-4/12 p-5 text-white"
                tabindex="1"
            >
                <div class="flex cursor-pointer items-center justify-between">
                    <h5 class="text-white opacity-60 font-bold">Subscribe for newsletter</h5>
                </div>
                <div
                    class=" h-auto xl:max-h-screen items-center transition-all group-focus:visible group-focus:max-h-screen group-focus:opacity-100 group-focus:duration-1000"
                >
                    <div class="w-full mt-7 relative">
                        <input class="bg-white/5 w-full focus:border-none focus:outline-hidden placeholder-white/50 py-5 px-3 rounded-2xl border border-dark/50" type="text" name="email" placeholder="Your e-mail address">
                        <button class="absolute cursor-pointer z-10 top-1 right-1 bg-charcoal text-olive font-bold py-4 px-7 rounded-2xl hover:text-white hover:bg-dark-olive duration-700">Subscribe</button>
                    </div>
                </div>
            </div>
            <hr class="mt-7 xl:hidden border border-dark">

        </div>


        <hr class="xl:mt-7 border border-dark">
        <div class="flex text-white justify-between items-center text-[12px] mt-7">
            <p class="opacity-25 py-1 ">© 2023 KIDD. <span class="invisible xl:visible"> All Rights Reserved</span></p>
            <ul class="flex gap-x-5">
                <li class="opacity-25 py-1"><a href="#">Privacy Terms</a></li>
                <li class="opacity-25 py-1"><a href="#">Cookies Policy</a></li>
            </ul>
        </div>
    </div>

</footer>
