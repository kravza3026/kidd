<section class="container pt-section ">
    <h2 class="section-title text-[30px] md:text-[48px] font-[700] pb-5">New arrivals</h2>
    <div class="py-5 font-[700] flex justify-between overflow-x-auto md:overflow-hidden">
        <ul class="flex gap-2 2xl:gap-6 cursor-pointer">
            <x-ui.size-tag>Preemie</x-ui.size-tag>
            <x-ui.size-tag>0-3M</x-ui.size-tag>
            <x-ui.size-tag>3-6M</x-ui.size-tag>
            <x-ui.size-tag>6-9M</x-ui.size-tag>
            <x-ui.size-tag>9-12M</x-ui.size-tag>
            <x-ui.size-tag>12-18M</x-ui.size-tag>
            <x-ui.size-tag>18-24M</x-ui.size-tag>
            <x-ui.size-tag>2Y</x-ui.size-tag>
            <x-ui.size-tag>3-4Y</x-ui.size-tag>
        </ul>
        <a href="#" class="text-olive light_border px-4 py-2 bg-light-orange hover:bg-light-border animated flex items-center text-nowrap text-[14px]  mx-2">View all products</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 gap-x-3 gap-y-5 sm:gap-y-12 mt-5">
        {{-- Product cards --}}
        @foreach($products as $product)
            <x-product-card :$product />
        @endforeach
    </div>
</section>
