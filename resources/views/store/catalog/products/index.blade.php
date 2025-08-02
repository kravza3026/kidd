<x-app-layout>
    <main class="container">
        <div class=" bg-white z-50  mt-12 mb-6 flex-col justify-start items-start gap-6 flex">
            <div class="justify-start items-start gap-2 inline-flex">
                <div class="opacity-80 text-black text-5xl font-bold leading-10">{{ $category->exists ? $category->name : __('general.products') }}</div>
                <div class="px-2 py-1.5 bg-olive rounded-xl justify-center items-center flex">
                    <div class="text-white text-sm font-extrabold leading-none">{{ $products->total() }}</div>
                </div>
            </div>
            @include('store.catalog.products._filters')
        </div>

        <div class="mb-24 space-y-20">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 gap-y-6">
                <!-- Product grid -->
                @forelse ($products as $product)
                    <div data-vue-component="ProductCard"
                         data-product='@json($product)'
                    ></div>
                @empty
                    <p>No products found</p>
                @endforelse
            </div>
            {{ $products->onEachSide(1)->links() }}
        </div>
    </main>
</x-app-layout>
