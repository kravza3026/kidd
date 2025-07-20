<section class="container pt-section ">
    <div class="flex justify-between overflow-x-scroll md:overflow-hidden w-full gap-5">
        @for ($i = 1; $i <= 4; $i++)
            <x-category-card
                title="Jumpsuits"
                background-image="{{ asset('assets/images/categories/category_' . $i . '.svg') }}"
                link="/categories/jumpsuits"
            />
        @endfor
    </div>
</section>
