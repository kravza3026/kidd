<x-app-layout>
    <div class="max-w-7xl mx-auto sm:bg-transparent sm:pt-16 sm:pb-20">
        <div class="shadow-2xl sm:rounded-xl">

            <div class="p-6 md:px-10 mb-4">
                <!-- Product grid -->
                {{--            // TODO - update this condition when we have a proper favorites system--}}
                <div class="mb-12 space-y-20">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 gap-y-6">
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
            </div>
        </div>
    </div>
</x-app-layout>
