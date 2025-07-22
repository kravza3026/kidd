<section class="container  pt-section ">
    <h2 class="section-title text-[30px] md:text-[48px] font-[700] pb-5">Complete the look</h2>
    <div class="flex flex-nowrap  grid-cols-1 md:grid overflow-hidden sm:grid-cols-3 md:grid-cols-4 gap-x-3 gap-y-5 sm:gap-y-12 mt-5">
        {{-- Product cards --}}

{{--        @foreach($products as $product)--}}

{{--            --}}{{--            <x-product-card :$product />--}}
{{--            <div data-vue-component="ProductCard"--}}
{{--                 data-product='@json($product)'--}}
{{--                 data-locale='{{app()->getLocale()}}'--}}
{{--                 data-link="{{ $product->link() }}"--}}

{{--            ></div>--}}

{{--        @endforeach--}}
        <div class="w-full"
             data-vue-component="ProductsCardsSlider"
             data-vue-props='@json([
            "products" => $products
    ])'
        ></div>
    </div>
</section>
