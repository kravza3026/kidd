<section class="container pt-section ">
    <h2 class="section-title text-[30px] md:text-[48px] font-[700] pb-5">Similar styles</h2>
    <div class="mt-5">
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
            "products" => $products,
            "locale" => app()->getLocale()
    ])'
        ></div>
    </div>
</section>
