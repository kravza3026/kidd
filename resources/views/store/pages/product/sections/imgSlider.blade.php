@php
    $variantImages = collect($product->getMedia('gallery'))
        ->flatMap(function ($images) {
            return collect($images->getUrl('full'));
        })
        ->filter()
        ->unique()
        ->values();

    $slides = collect([$product->media[0]->original_url])
        ->merge($variantImages)
        ->unique()
        ->values();
@endphp

<div class="md:min-w-1/2 max-w-full  sm:max-w-2/3 lg:max-w-full mx-auto w-full sm:p-2  rounded-xl lg:sticky top-2 flex-col justify-center items-center gap-8 inline-flex">
    <div class="max-w-full w-full h-fit" data-vue-component="ProductSlider"
         data-vue-props='@json(["slides" => $slides])'>
        {{-- gallery --}}
    </div>
</div>
