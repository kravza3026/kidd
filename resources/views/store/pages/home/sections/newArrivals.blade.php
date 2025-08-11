<section class="pl-[20px] md:container pt-section md:mt-16">
    <h2 class="section-title text-[30px] md:text-[48px] font-[700] pb-5">
        New arrivals
    </h2>
    <div class="py-5 font-[700] flex justify-between overflow-x-auto md:overflow-hidden">
        <ul class="flex gap-2 2xl:gap-6 cursor-pointer">
            @foreach($sizes as $size)
                <x-ui.size-tag :link="route('products.index', ['filters[size]['.$size->id.']' => true, 'filters[sort]' => 'newest', 'filters[new]' => true])">
                    {{ $size->name }}
                </x-ui.size-tag>
            @endforeach
        </ul>
        <a href="{{ route('products.index') }}" class="text-olive light_border px-4 py-2 bg-light-orange hover:bg-light-border animated flex items-center text-nowrap text-sm mx-2">View all products</a>
    </div>

    <div class="mt-5">
        {{-- Product cards --}}
        <div class="w-full"
             data-vue-component="ProductsCardsSlider"
             data-vue-props='@json(["products" => $products])'
        ></div>
    </div>
</section>
