<footer class="bg-charcoal mt-7 pt-10 pb-[95px]" x-data="{
    open: null,
    toggle(idx) {
        this.open = this.open === idx ? null : idx;
    }
}">
    <div class="container">
        <div class="grid grid-cols-1 xl:flex xl:justify-between space-y-2">
            <!-- Follow Us -->
            <div class="order-last xl:order-first flex justify-between xl:justify-start xl:flex-col items-center xl:items-start gap-2 bg-black p-5 text-white">
                <div class="flex items-center justify-between">
                    <h5 class="text-white opacity-60 font-bold">Follow us on</h5>
                </div>
                <ul class="flex items-center gap-4 xl:mt-7">
                    <li><a href="#"><img src="{{ asset('assets/images/icons/socials/facebook.svg') }}" alt=""></a></li>
                    <li><a href="#"><img src="{{ asset('assets/images/icons/socials/ln.svg') }}" alt=""></a></li>
                    <li><a href="#"><img src="{{ asset('assets/images/icons/socials/youtube_i.svg') }}" alt=""></a></li>
                    <li><a href="#"><img src="{{ asset('assets/images/icons/socials/messenger.svg') }}" alt=""></a></li>
                </ul>
            </div>

            <!-- Accordion Block Template -->
            <template x-for="(section, idx) in [
                { title: 'Catalog', items: ['Jumpsuits','Jackets','Bodysuits','Pants','Sets'] },
                { title: 'Help', items: ['Frequent questions','Size chart','Return Policy','Delivery info','Contact us'] },
                { title: 'Company', items: ['About us','Store locations','Careers','Terms & Conditions'] }
            ]" :key="idx">
                <div class="flex flex-col gap-2 rounded-lg bg-black p-5 text-white">
                    <button type="button" @click="toggle(idx)" class="flex items-center justify-between cursor-pointer w-full xl:cursor-default">
                        <h5 class="text-white opacity-60 font-bold " x-text="section.title" :class="{ 'opacity-100': open === idx }"></h5>
                        <img class="w-3 transition-transform duration-500 xl:invisible opacity-60 -rotate-180" :class="{ 'rotate-0 opacity-100': open === idx }" src="{{ asset('assets/images/icons/accordion_arrow.png') }}" alt="">
                    </button>

                    <div
                        class="overflow-hidden transition-all duration-500 xl:visible xl:max-h-screen xl:opacity-100"
                        :class="{
                            'max-h-0 opacity-0 invisible': open !== idx,
                            'max-h-screen opacity-100 visible': open === idx
                        }"
                    >
                        <ul class="mt-5">
                            <template x-for="item in section.items" :key="item">
                                <li class="opacity-25 py-2"><a href="#" x-text="item"></a></li>
                            </template>
                        </ul>
                    </div>
                </div>
            </template>

            <!-- Subscribe -->
            <div class="flex flex-col gap-2 rounded-lg bg-black xl:min-w-4/12 p-5 text-white">
                <div class="flex items-center justify-between">
                    <h5 class="text-white opacity-60 font-bold">Subscribe for newsletter</h5>
                </div>
                <div class="h-auto xl:max-h-screen items-center transition-all">
                    <div class="w-full mt-7 relative">
                        <input class="bg-white/5 w-full placeholder-white/50 py-5 px-3 rounded-2xl border border-dark/50 focus:outline-none" type="text" name="email" placeholder="Your e-mail address">
                        <button class="absolute top-1 right-1 bg-charcoal text-olive font-bold py-4 px-7 rounded-2xl hover:text-white hover:bg-dark-olive duration-700">Subscribe</button>
                    </div>
                </div>
            </div>

            <hr class="mt-7 xl:hidden border border-dark">
        </div>

        <hr class="xl:mt-7 border border-dark">
        <div class="flex text-white justify-between items-center text-[12px] mt-7">
            <div class="flex items-center py-1 w-3/12 xl:w-auto">
                <p class="opacity-25">© 2023 KIDD. <span class="hidden xl:block">All Rights Reserved</span></p>
            </div>

            <ul class="flex gap-x-2 w-6/12 py-1 xl:w-auto">
                <li class="opacity-25"><a href="#">Privacy Terms</a></li>
                <li class="opacity-25"><a href="#">Cookies Policy</a></li>
            </ul>
        </div>
    </div>
</footer>
