@php
    $slides = $product->getMedia('gallery')
        ->map(fn($media) => $media->original_url)
        ->filter()
        ->unique()
        ->values();
@endphp

<div class="md:min-w-1/2 max-w-full  sm:max-w-2/3 lg:max-w-full mx-auto w-full sm:p-2  rounded-xl lg:sticky top-2 flex-col justify-center items-center gap-8 inline-flex">
    <product-slider :slides='@json($slides)' class="max-w-full w-full h-fit"></product-slider>
</div>
