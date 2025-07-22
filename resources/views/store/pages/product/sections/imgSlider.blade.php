@php
    $variantImages = collect($product->variants)
        ->pluck('images')
        ->filter()
        ->flatMap(function ($images) {
            if (is_string($images)) {
                $images = json_decode($images, true);
            }
            return collect($images)->filter()->values();
        })
        ->filter()
        ->unique()
        ->values();

    $slides = collect([$product->main_image])
        ->merge($variantImages)
        ->unique()
        ->values();
@endphp

<div class="md:min-w-[550px] w-full sm:p-2 bg-[#f6f6f6] rounded-xl md:sticky top-2 flex-col justify-center items-center gap-8 inline-flex">
    <div class="max-w-full h-fit" data-vue-component="ProductSlider"
         data-vue-props='@json(["slides" => $slides])'>
        {{-- gallery --}}
    </div>
</div>
