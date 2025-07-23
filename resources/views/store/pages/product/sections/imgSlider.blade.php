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

<div class="md:min-w-1/2 max-w-full  sm:max-w-2/3 lg:max-w-full mx-auto w-full sm:p-2  rounded-xl lg:sticky top-2 flex-col justify-center items-center gap-8 inline-flex">
    <div class="max-w-full h-fit" data-vue-component="ProductSlider"
         data-vue-props='@json(["slides" => $slides])'>
        {{-- gallery --}}
    </div>
</div>
