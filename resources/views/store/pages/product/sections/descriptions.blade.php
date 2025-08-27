<div class="mb-3 w-full">
    <input type="checkbox" checked name="description" class="peer hidden" id="description" />
    <label
        for="description"
        class="flex cursor-pointer items-center justify-between py-2 peer-checked:[&_.accordion-arrow]:rotate-180"
    >
        <span class="text-base font-medium">{{ __('product-show.desc.title') }}</span>
        <span class="accordion-arrow opacity-40 transition-all duration-300">
            <img src="{{ Vite::image('icons/top_arrow.svg') }}" alt="arrow icon folding and unfolding" />
        </span>
    </label>
    <div class="hidden py-4 peer-checked:block">
        <ul class="flex flex-col gap-4 pr-7 text-sm">
            <li class="flex items-center">
                <p class="opacity-40">{{ __('product-show.desc.article') }}</p>
                <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10"></span>
                <p>{{ $product->barcode }} / {{ $product->variants->first()->sku }}</p>
            </li>
            <li class="flex items-center">
                <p class="opacity-40">{{ __('product-show.desc.gender') }}</p>
                <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10"></span>
                <p>{{ $product->gender->name }}</p>
            </li>
            <li class="flex items-center">
                <p class="opacity-40">{{ __('product-show.desc.fabric') }}</p>
                <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10"></span>
                <p>{{ $product->fabric->name }}</p>
            </li>
            <li class="flex items-center">
                <p class="opacity-40">{{ __('product-show.desc.season') }}</p>
                <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10"></span>
                <p>{{ $product->season->name }}</p>
            </li>
            <li class="flex items-center">
                <p class="opacity-40">{{ __('product-show.desc.sleeve') }}</p>
                <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10"></span>
                <p>Short-sleeved</p>
            </li>
            <li class="flex items-center">
                <p class="opacity-40">{{ __('product-show.desc.closure') }}</p>
                <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10"></span>
                <p>Button fastened</p>
            </li>
        </ul>
    </div>
</div>
<div class="my-3 w-full">
    <input type="checkbox" name="instructions" class="peer hidden" id="instructions" />
    <label
        for="instructions"
        class="flex cursor-pointer items-center justify-between py-2 peer-checked:[&_.accordion-arrow]:rotate-180"
    >
        <span class="text-base font-medium">Material care instructions</span>
        <span class="accordion-arrow opacity-40 transition-all duration-300">
            <img src="{{ Vite::image('icons/top_arrow.svg') }}" alt="" />
        </span>
    </label>
    <div class="hidden py-4 peer-checked:block">
        <ul class="flex flex-col gap-4 pr-7 text-sm">
            <li class="flex items-center gap-4">
                <div class="bg-light-orange flex size-10 items-center justify-center rounded-full">
                    <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAACxAAAAsQHGLUmNAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAUxJREFUSInt079LW2EUxvFPbExoHKSVUoRMHcRBqFMKLiIodKmDRTp0r1Aourj4N7gXp0JHpUvBoVP3DA5icevi6C5taq3DPQmvLzfRCi7qFy73vM99zjnvr8s9d4rWTdQaSsT5JG7gQUliPZ6cWqb3alUT8RhP8BYPMYZttOP7MqYiPsBOxK/wAh38xLeoBSrZstawib3Q3uNRNGzja+iL4f+LHzEReIk3+JhMrEcjGuTUs5V2qWK4RF+NWj1Tl5P0Q8LvEg1O++gjUQsXD3kQw5HY5Sme9fH+Swd5g47iRuSs4HHEk3iHWSxlvhr+DGpwGAVSxhUrmI7xDLbwCROZdzJq9G2wj+eZtoBRxY16rdj7skMXufupkBuP0My0z/H+gC+K/V/HL+xm3mbUGMjGZYb/yb3qLboqZ7lQKTG1MHfNBt+V/MH33HLOAdUiLtxCP/GcAAAAAElFTkSuQmCC"
                        alt=""
                    />
                </div>
                <p>Wash at 40° to preserve the quality and colour of the fabric</p>
            </li>
            <li class="flex items-center gap-4">
                <div class="bg-light-orange flex size-10 items-center justify-center rounded-full">
                    <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAACxAAAAsQHGLUmNAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAUxJREFUSInt079LW2EUxvFPbExoHKSVUoRMHcRBqFMKLiIodKmDRTp0r1Aourj4N7gXp0JHpUvBoVP3DA5icevi6C5taq3DPQmvLzfRCi7qFy73vM99zjnvr8s9d4rWTdQaSsT5JG7gQUliPZ6cWqb3alUT8RhP8BYPMYZttOP7MqYiPsBOxK/wAh38xLeoBSrZstawib3Q3uNRNGzja+iL4f+LHzEReIk3+JhMrEcjGuTUs5V2qWK4RF+NWj1Tl5P0Q8LvEg1O++gjUQsXD3kQw5HY5Sme9fH+Swd5g47iRuSs4HHEk3iHWSxlvhr+DGpwGAVSxhUrmI7xDLbwCROZdzJq9G2wj+eZtoBRxY16rdj7skMXufupkBuP0My0z/H+gC+K/V/HL+xm3mbUGMjGZYb/yb3qLboqZ7lQKTG1MHfNBt+V/MH33HLOAdUiLtxCP/GcAAAAAElFTkSuQmCC"
                        alt=""
                    />
                </div>
                <p>Avoid using bleach as it can damage the fabric</p>
            </li>
            ...
        </ul>
    </div>
</div>
