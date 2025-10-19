<section class="bg-light-orange hidden lg:block">
    <div class="container pb-16">
        <div class="w-full py-[60px] text-center">
            <h2 class="text-[42px]">Frequent questions</h2>
            <p class="opacity-60">Key points about which you may have questions</p>
        </div>
        <div class="py-5">
            <div class="flex w-full gap-x-24">
                <div class="flex w-5/7 items-start justify-between gap-x-5">
                    <img src="{{ asset('assets/images/product-page/frequent_icon_1.png') }}" alt="size" />
                    <div class="">
                        <h4 class="py-2 text-[20px] font-[500]">
                            Can I exchange or return this jumpsuit if it doesn't fit?
                        </h4>
                        <p class="text-charcoal text-[16px] font-normal opacity-80">
                            We understand the difficulty of finding the perfect fit for your little one  so if the
                            jumpsuit doesn't fit as expected, we offer hassle-free exchanges or returns within 30 days
                            of purchase. Please note that the jumpsuit must be unworn, in its original condition, and
                            with all tags attached. Also don’t forget to check our size chart.
                        </p>
                        <x-ui.button
                            as="a"
                            href="{{ route('size-chart') }}"
                            size="large"
                            left_icon="false"
                            right_icon="false"
                            class="my-5 font-bold"
                        >
                            <img src="{{ asset('assets/images/icons/size_white.png') }}" alt="size" />
                            Check size
                        </x-ui.button>
                    </div>
                </div>
                <div class="relative w-3/5">
                    <img
                        class="absolute top-1/2 -left-1/3"
                        src="{{ asset('assets/images/product-page/handWritten_1.png') }}"
                        alt="size"
                    />
                    <img
                        class="rounded-2xl"
                        src="{{ asset('assets/images/product-page/banners/productPage-banner_1.jpg') }}"
                        alt="size"
                    />
                </div>
            </div>
            <div class="mt-14 flex w-full gap-x-24">
                <div class="order-last flex w-5/7 items-start justify-between gap-x-10">
                    <img src="{{ asset('assets/images/product-page/frequent_icon_2.png') }}" alt="size" />
                    <div class="">
                        <h4 class="py-2 text-[20px] font-[500]">Can I purchase gift wrapping for this jumpsuit?</h4>
                        <p class="text-charcoal text-[16px] font-normal opacity-80">
                            Our gift wrapping includes a beautifully designed wrapping paper, ribbon, and a personalised
                            gift tag. It's the perfect way to add an extra touch of care to your purchase, whether it's
                            for a baby birthday or other special occasion. Select the gift option for a small additional
                            fee at checkout, and leave the rest to us!
                        </p>
                    </div>
                </div>
                <div class="relative -mt-36 w-3/5">
                    <img
                        class="absolute top-2/3 -right-1/3"
                        src="{{ asset('assets/images/product-page/handWritten_2.png') }}"
                        alt="size"
                    />
                    <img
                        class="rounded-2xl"
                        src="{{ asset('assets/images/product-page/banners/productPage-banner_2.jpg') }}"
                        alt="size"
                    />
                </div>
            </div>

            <div class="mt-14 flex w-full gap-x-24">
                <div class="flex w-5/7 items-start justify-between gap-x-10">
                    <img src="{{ asset('assets/images/product-page/frequent_icon_3.png') }}" alt="size" />
                    <div class="">
                        <h4 class="py-2 text-[20px] font-[500]">How long will it take for the jumpsuit to arrive?</h4>
                        <p class="text-charcoal text-[16px] font-normal opacity-80">
                            The delivery time for your order varies based on your location and selected shipping method.
                            We typically process orders within 1-2 business days, and delivery usually takes 3-7
                            business days for domestic orders. International orders may take longer. You'll receive a
                            confirmation email with tracking information to keep you informed.
                        </p>
                    </div>
                </div>
                <div class="relative -mt-36 w-3/5">
                    <img
                        class="absolute top-2/3 -left-1/3"
                        src="{{ asset('assets/images/product-page/handWritten_3.png') }}"
                        alt="size"
                    />
                    <img
                        class="rounded-2xl"
                        src="{{ asset('assets/images/product-page/banners/productPage-banner_3.jpg') }}"
                        alt="size"
                    />
                </div>
            </div>

            <div class="mt-14 flex w-full gap-x-24">
                <div class="order-last flex w-5/7 items-start justify-between gap-x-7">
                    <img src="{{ asset('assets/images/product-page/frequent_icon_4.png') }}" alt="size" />
                    <div class="">
                        <h4 class="py-2 text-[20px] font-[500]">
                            Is this jumpsuit suitable for all seasons or just summer?
                        </h4>
                        <p class="text-charcoal text-[16px] font-normal opacity-80">
                            The fabric used is lightweight and breathable, making it comfortable for summer wear.
                            However, with layering, this jumpsuit can be easily transitioned for cooler seasons as well.
                            Simply pair it with a cozy sweater or jacket, and your little one can enjoy wearing it
                            throughout the year.
                        </p>
                    </div>
                </div>
                <div class="relative -mt-36 w-3/5">
                    <img
                        class="absolute -right-1/3 bottom-0"
                        src="{{ asset('assets/images/product-page/handWritten_4.png') }}"
                        alt="size"
                    />
                    <img
                        class="rounded-2xl"
                        src="{{ asset('assets/images/product-page/banners/productPage-banner_4.jpg') }}"
                        alt="size"
                    />
                </div>
            </div>
        </div>
    </div>
</section>
