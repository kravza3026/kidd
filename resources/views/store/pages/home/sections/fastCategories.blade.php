<section class="container pt-section ">
    <div class="flex justify-between overflow-x-scroll md:overflow-hidden w-full gap-5">
        @foreach ($clothes->subcategories->take(4) as $category)
            <x-category-card
                title="{{ $category->name }}"
                background-image="{{ Vite::image($category->image) }}"
                link="{{ route('products.category.index', $category) }}"
            />
        @endforeach
    </div>
</section>
