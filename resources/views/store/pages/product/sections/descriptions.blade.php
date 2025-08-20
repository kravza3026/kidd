{{--{{dd($product)}}--}}

<div class="mb-3 w-full">
    <input type="checkbox"  name="description" class="hidden peer" id="description">
    <label for="description" class="flex justify-between items-center py-2 cursor-pointer peer-checked:[&_.accordion-arrow]:rotate-180">
            <span class="font-medium text-base">{{ __('product-show.desc.title') }}</span>
            <span class="accordion-arrow transition-all duration-300 opacity-40">
                <img src="{{ Vite::image('icons/top_arrow.svg') }}" alt="">
            </span>
    </label>
    <div class="peer-checked:block hidden py-4">
        <ul class="flex flex-col gap-4 text-sm pr-7">
            <li class="flex items-center">
                <p class="opacity-40">{{ __('product-show.desc.article') }}</p>
                <span class="flex-1 mx-2 opacity-10 mt-3"
                      style="height: 2px; background-image: repeating-linear-gradient(to right, #000 0 2px, transparent 2px 6px);">
                </span>
                <p>{{ $product->barcode }} /
                    {{ $product->variants->first()->sku }}</p>
            </li>
            <li class="flex items-center">
                <p class="opacity-40"> {{ __('product-show.desc.gender') }}</p>
                <span class="flex-1 mx-2 opacity-10 mt-3"
                      style="height: 2px; background-image: repeating-linear-gradient(to right, #000 0 2px, transparent 2px 6px);">
                </span>
                <p>{{ $product->gender->name }}</p>
            </li>
            <li class="flex items-center">
                <p class="opacity-40"> {{ __('product-show.desc.fabric') }}</p>
                <span class="flex-1 mx-2 opacity-10 mt-3"
                      style="height: 2px; background-image: repeating-linear-gradient(to right, #000 0 2px, transparent 2px 6px);">
                </span>
                <p>{{ $product->fabric->name }}</p>
            </li>
            <li class="flex items-center">
                <p class="opacity-40">{{ __('product-show.desc.season') }}</p>
                <span class="flex-1 mx-2 opacity-10 mt-3"
                      style="height: 2px; background-image: repeating-linear-gradient(to right, #000 0 2px, transparent 2px 6px);">
                </span>
                <p>{{ $product->season->name }}</p>
            </li>
            <li class="flex items-center">
                <p class="opacity-40">{{ __('product-show.desc.sleeve') }}</p>
                <span class="flex-1 mx-2 opacity-10 mt-3"
                      style="height: 2px; background-image: repeating-linear-gradient(to right, #000 0 2px, transparent 2px 6px);">
                </span>
                <p>Short-sleeved</p>
            </li>
            <li class="flex items-center">
                <p class="opacity-40">{{ __('product-show.desc.closure') }}</p>
                <span class="flex-1 mx-2 opacity-10 mt-3"
                      style="height: 2px; background-image: repeating-linear-gradient(to right, #000 0 2px, transparent 2px 6px);">
                </span>
                <p>Button fastened</p>
            </li>
        </ul>
    </div>
</div>
<div class="my-3 w-full">
    <input type="checkbox" name="instructions" class="hidden peer" id="instructions">
    <label for="instructions" class="flex justify-between items-center py-2 cursor-pointer peer-checked:[&_.accordion-arrow]:rotate-180">
        <span class="font-medium text-base">Material care instructions</span>
        <span class="accordion-arrow transition-all duration-300 opacity-40">
                <img src="{{ Vite::image('icons/top_arrow.svg') }}" alt="">
            </span>
    </label>
    <div class="peer-checked:block hidden py-4">
        <ul class="flex flex-col gap-4 text-sm pr-7">
           <li class="flex gap-4 items-center">
               <div class="bg-light-orange size-10 rounded-full flex items-center justify-center">
                   <img
                       src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAACxAAAAsQHGLUmNAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAUxJREFUSInt079LW2EUxvFPbExoHKSVUoRMHcRBqFMKLiIodKmDRTp0r1Aourj4N7gXp0JHpUvBoVP3DA5icevi6C5taq3DPQmvLzfRCi7qFy73vM99zjnvr8s9d4rWTdQaSsT5JG7gQUliPZ6cWqb3alUT8RhP8BYPMYZttOP7MqYiPsBOxK/wAh38xLeoBSrZstawib3Q3uNRNGzja+iL4f+LHzEReIk3+JhMrEcjGuTUs5V2qWK4RF+NWj1Tl5P0Q8LvEg1O++gjUQsXD3kQw5HY5Sme9fH+Swd5g47iRuSs4HHEk3iHWSxlvhr+DGpwGAVSxhUrmI7xDLbwCROZdzJq9G2wj+eZtoBRxY16rdj7skMXufupkBuP0My0z/H+gC+K/V/HL+xm3mbUGMjGZYb/yb3qLboqZ7lQKTG1MHfNBt+V/MH33HLOAdUiLtxCP/GcAAAAAElFTkSuQmCC"
                       alt="">
               </div>
               <p>Wash at 40° to preserve the quality and colour of the fabric</p>
           </li>
            <li class="flex gap-4 items-center">
                <div class="bg-light-orange size-10 rounded-full flex items-center justify-center">
                    <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAACxAAAAsQHGLUmNAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAUxJREFUSInt079LW2EUxvFPbExoHKSVUoRMHcRBqFMKLiIodKmDRTp0r1Aourj4N7gXp0JHpUvBoVP3DA5icevi6C5taq3DPQmvLzfRCi7qFy73vM99zjnvr8s9d4rWTdQaSsT5JG7gQUliPZ6cWqb3alUT8RhP8BYPMYZttOP7MqYiPsBOxK/wAh38xLeoBSrZstawib3Q3uNRNGzja+iL4f+LHzEReIk3+JhMrEcjGuTUs5V2qWK4RF+NWj1Tl5P0Q8LvEg1O++gjUQsXD3kQw5HY5Sme9fH+Swd5g47iRuSs4HHEk3iHWSxlvhr+DGpwGAVSxhUrmI7xDLbwCROZdzJq9G2wj+eZtoBRxY16rdj7skMXufupkBuP0My0z/H+gC+K/V/HL+xm3mbUGMjGZYb/yb3qLboqZ7lQKTG1MHfNBt+V/MH33HLOAdUiLtxCP/GcAAAAAElFTkSuQmCC"
                        alt="">
                </div>
                <p>Avoid using bleach as it can damage the fabric</p>
            </li>
            ...
        </ul>
    </div>
</div>


