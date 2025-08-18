{{--{{dd($product)}}--}}

<div class="my-6 w-full">
    <div class="flex justify-between items-center">
        <h2 class="font-medium text-base">{{ __('product-show.desc.title') }}</h2>
        <p><</p>
    </div>
    <div class="">
        <ul>
            <li class="flex items-center">
                <p class="opacity-40">Article</p>
                <span class="flex-1 mx-2 opacity-10 mt-3"
                      style="height: 2px; background-image: repeating-linear-gradient(to right, #000 0 2px, transparent 2px 6px);">
                </span>
                <p>#156936</p>
            </li>
        </ul>
    </div>
</div>


<div  class="pb-4 w-full border-b border-zinc-100">
    Этот весь колхоз нужно удалить, с точками которые я делал и сделать нормально.
    А так же всё лишнее что мне когда сгенерил AI нужно удалить, типа grow/shrink/basis...
    как и везде, где есть лишние классы, которые не нужны. и ещё коменты в телеге.
    <div class="w-full flex justify-between items-center pt-8 pb-4">
        <div class="inline-flex text-black text-base font-medium ">
            {{ __('product-show.desc.title') }}
        </div>
        <div class="inline-flex opacity-40">&downarrow;</div>
    </div>

    <div class="w-full py-4">
        <div class="w-full lg:max-w-1/2 xl:max-w-full flex flex-col justify-center items-start gap-6">
            <div class="w-full justify-between inline-flex">
                <div class="inline-flex text-black/40 text-sm font-normal ">
                    {{ __('product-show.desc.article') }}
                </div>
                <div class="flex grow shrink basis-0 pb-1 ml-2 mr-2 justify-start items-end gap-1 overflow-hidden">
                    <span class="h-px border border-zinc-200 rounded-full"></span>
                </div>
                <div class="inline-flex text-right text-black text-sm font-medium ">
                    {{ $product->barcode }} /
                    {{ $product->variants->first()->sku }}
                </div>
            </div>
            <div class="w-full justify-between inline-flex">
                <div class="inline-flex text-black/40 text-sm font-normal ">
                    {{ __('product-show.desc.gender') }}
                </div>
                <div class="flex grow shrink basis-0 pb-1 ml-2 mr-2 justify-start items-end gap-1 overflow-hidden">
                    <span class="h-px border border-zinc-200 rounded-full"></span>
                </div>
                <div class="text-right text-black text-sm font-medium ">
                    {{ $product->gender->name }}
                </div>
            </div>
            <div class="w-full justify-between inline-flex">
                <div class="inline-flex text-black/40 text-sm font-normal ">
                    {{ __('product-show.desc.fabric') }}
                </div>
                <div class="flex grow shrink basis-0 pb-1 ml-2 mr-2 justify-start items-end gap-1 overflow-hidden">
                    <span class="h-px border border-zinc-200 rounded-full"></span>
                </div>
                <div class="text-right text-black text-sm font-medium ">
                    {{ $product->fabric->name }}
                </div>
            </div>
            <div class="w-full justify-between inline-flex">
                <div class="inline-flex text-black/40 text-sm font-normal ">
                    {{ __('product-show.desc.season') }}
                </div>
                <div class="flex grow shrink basis-0 pb-1 ml-2 mr-2 justify-start items-end gap-1 overflow-hidden">
                    <span class="h-px border border-zinc-200 rounded-full"></span>
                </div>
                <div class="text-right text-black text-sm font-medium ">
                    {{ $product->season->name }}
                </div>
            </div>
            <div class="w-full justify-between inline-flex">
                <div class="inline-flex text-black/40 text-sm font-normal ">
                    {{ __('product-show.desc.sleeve') }}
                </div>
                <div class="flex grow shrink basis-0 pb-1 ml-2 mr-2 justify-start items-end gap-1 overflow-hidden">
                    <span class="h-px border border-zinc-200 rounded-full"></span>
                    <span class="h-px border border-zinc-200 rounded-full"></span>
                </div>
                <div class="text-right text-black text-sm font-medium ">Short-sleeved</div>
            </div>
            <div class="w-full justify-between inline-flex">
                <div class="inline-flex text-black/40 text-sm font-normal ">
                    {{ __('product-show.desc.closure') }}
                </div>
                <div class="flex grow shrink basis-0 pb-1 ml-2 mr-2 justify-start items-end gap-1 overflow-hidden">
                    <span class="h-px border border-zinc-200 rounded-full"></span>
                    <span class="h-px border border-zinc-200 rounded-full"></span>
                </div>
                <div class="text-right text-black text-sm font-medium ">Button fastened</div>
            </div>
        </div>
    </div>
</div>

<div class="pb-4 w-full border-b border-zinc-100">
    <div class="w-full flex justify-between items-center pt-8 pb-4">
        <div class="inline-flex text-black text-base font-medium ">Material care instructions</div>
        <div class="inline-flex opacity-40">&downarrow;</div>
    </div>
    <div class=" h-80 pr-10 pt-2 pb-4 bg-white flex-col justify-start items-start gap-5 flex">
        <div class="  flex-col justify-start items-start gap-6 flex">
            <div class=" justify-start items-center gap-4 inline-flex">
                <div class="w-10 h-10 p-2 bg-[#f8f7f2] rounded-[100px] justify-center items-center flex">
                    <div class="w-6 h-6 relative opacity-80 flex-col justify-start items-start flex">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAACxAAAAsQHGLUmNAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAUxJREFUSInt079LW2EUxvFPbExoHKSVUoRMHcRBqFMKLiIodKmDRTp0r1Aourj4N7gXp0JHpUvBoVP3DA5icevi6C5taq3DPQmvLzfRCi7qFy73vM99zjnvr8s9d4rWTdQaSsT5JG7gQUliPZ6cWqb3alUT8RhP8BYPMYZttOP7MqYiPsBOxK/wAh38xLeoBSrZstawib3Q3uNRNGzja+iL4f+LHzEReIk3+JhMrEcjGuTUs5V2qWK4RF+NWj1Tl5P0Q8LvEg1O++gjUQsXD3kQw5HY5Sme9fH+Swd5g47iRuSs4HHEk3iHWSxlvhr+DGpwGAVSxhUrmI7xDLbwCROZdzJq9G2wj+eZtoBRxY16rdj7skMXufupkBuP0My0z/H+gC+K/V/HL+xm3mbUGMjGZYb/yb3qLboqZ7lQKTG1MHfNBt+V/MH33HLOAdUiLtxCP/GcAAAAAElFTkSuQmCC"
                            alt="">
                    </div>
                </div>
                <div class="text-[#020202] text-sm font-normal leading-[18.20px]">Wash at 40° to preserve the quality and colour of the fabric</div>
            </div>
            <div class=" justify-start items-center gap-4 inline-flex">
                <div class="w-10 h-10 p-2 bg-[#f8f7f2] rounded-[100px] justify-center items-center flex">
                    <div class="w-6 h-6 relative opacity-80 flex-col justify-start items-start flex">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAACxAAAAsQHGLUmNAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAUxJREFUSInt079LW2EUxvFPbExoHKSVUoRMHcRBqFMKLiIodKmDRTp0r1Aourj4N7gXp0JHpUvBoVP3DA5icevi6C5taq3DPQmvLzfRCi7qFy73vM99zjnvr8s9d4rWTdQaSsT5JG7gQUliPZ6cWqb3alUT8RhP8BYPMYZttOP7MqYiPsBOxK/wAh38xLeoBSrZstawib3Q3uNRNGzja+iL4f+LHzEReIk3+JhMrEcjGuTUs5V2qWK4RF+NWj1Tl5P0Q8LvEg1O++gjUQsXD3kQw5HY5Sme9fH+Swd5g47iRuSs4HHEk3iHWSxlvhr+DGpwGAVSxhUrmI7xDLbwCROZdzJq9G2wj+eZtoBRxY16rdj7skMXufupkBuP0My0z/H+gC+K/V/HL+xm3mbUGMjGZYb/yb3qLboqZ7lQKTG1MHfNBt+V/MH33HLOAdUiLtxCP/GcAAAAAElFTkSuQmCC"
                            alt="">
                    </div>
                </div>
                <div class="text-[#020202] text-sm font-normal leading-[18.20px]">Avoid using bleach as it can damage the fabric</div>
            </div>
            <div class=" justify-start items-center gap-4 inline-flex">
                <div class="w-10 h-10 p-2 bg-[#f8f7f2] rounded-[100px] justify-center items-center flex">
                    <div class="w-6 h-6 relative opacity-80 flex-col justify-start items-start flex">
                        <img class="w-[21.50px] 50px]"
                             src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAACxAAAAsQHGLUmNAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAUxJREFUSInt079LW2EUxvFPbExoHKSVUoRMHcRBqFMKLiIodKmDRTp0r1Aourj4N7gXp0JHpUvBoVP3DA5icevi6C5taq3DPQmvLzfRCi7qFy73vM99zjnvr8s9d4rWTdQaSsT5JG7gQUliPZ6cWqb3alUT8RhP8BYPMYZttOP7MqYiPsBOxK/wAh38xLeoBSrZstawib3Q3uNRNGzja+iL4f+LHzEReIk3+JhMrEcjGuTUs5V2qWK4RF+NWj1Tl5P0Q8LvEg1O++gjUQsXD3kQw5HY5Sme9fH+Swd5g47iRuSs4HHEk3iHWSxlvhr+DGpwGAVSxhUrmI7xDLbwCROZdzJq9G2wj+eZtoBRxY16rdj7skMXufupkBuP0My0z/H+gC+K/V/HL+xm3mbUGMjGZYb/yb3qLboqZ7lQKTG1MHfNBt+V/MH33HLOAdUiLtxCP/GcAAAAAElFTkSuQmCC"/>
                    </div>
                </div>
                <div class="text-[#020202] text-sm font-normal leading-[18.20px]">To dry the fabric use tumble drying on a low heat setting</div>
            </div>
            <div class=" justify-start items-center gap-4 inline-flex">
                <div class="w-10 h-10 p-2 bg-[#f8f7f2] rounded-[100px] justify-center items-center flex">
                    <div class="w-6 h-6 relative opacity-80 flex-col justify-start items-start flex">
                        <img class="w-[21.50px] 50px]"
                             src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAACxAAAAsQHGLUmNAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAUxJREFUSInt079LW2EUxvFPbExoHKSVUoRMHcRBqFMKLiIodKmDRTp0r1Aourj4N7gXp0JHpUvBoVP3DA5icevi6C5taq3DPQmvLzfRCi7qFy73vM99zjnvr8s9d4rWTdQaSsT5JG7gQUliPZ6cWqb3alUT8RhP8BYPMYZttOP7MqYiPsBOxK/wAh38xLeoBSrZstawib3Q3uNRNGzja+iL4f+LHzEReIk3+JhMrEcjGuTUs5V2qWK4RF+NWj1Tl5P0Q8LvEg1O++gjUQsXD3kQw5HY5Sme9fH+Swd5g47iRuSs4HHEk3iHWSxlvhr+DGpwGAVSxhUrmI7xDLbwCROZdzJq9G2wj+eZtoBRxY16rdj7skMXufupkBuP0My0z/H+gC+K/V/HL+xm3mbUGMjGZYb/yb3qLboqZ7lQKTG1MHfNBt+V/MH33HLOAdUiLtxCP/GcAAAAAElFTkSuQmCC"/>
                    </div>
                </div>
                <div class="text-[#020202] text-sm font-normal leading-[18.20px]">Iron using a medium heat setting, with temperature max. 150°</div>
            </div>
            <div class=" justify-start items-center gap-4 inline-flex">
                <div class="w-10 h-10 p-2 bg-[#f8f7f2] rounded-[100px] justify-center items-center flex">
                    <div class="w-6 h-6 relative opacity-80 flex-col justify-start items-start flex">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAACxAAAAsQHGLUmNAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAUxJREFUSInt079LW2EUxvFPbExoHKSVUoRMHcRBqFMKLiIodKmDRTp0r1Aourj4N7gXp0JHpUvBoVP3DA5icevi6C5taq3DPQmvLzfRCi7qFy73vM99zjnvr8s9d4rWTdQaSsT5JG7gQUliPZ6cWqb3alUT8RhP8BYPMYZttOP7MqYiPsBOxK/wAh38xLeoBSrZstawib3Q3uNRNGzja+iL4f+LHzEReIk3+JhMrEcjGuTUs5V2qWK4RF+NWj1Tl5P0Q8LvEg1O++gjUQsXD3kQw5HY5Sme9fH+Swd5g47iRuSs4HHEk3iHWSxlvhr+DGpwGAVSxhUrmI7xDLbwCROZdzJq9G2wj+eZtoBRxY16rdj7skMXufupkBuP0My0z/H+gC+K/V/HL+xm3mbUGMjGZYb/yb3qLboqZ7lQKTG1MHfNBt+V/MH33HLOAdUiLtxCP/GcAAAAAElFTkSuQmCC"
                            alt="">
                    </div>
                </div>
                <div class="text-[#020202] text-sm font-normal leading-[18.20px]">This fabric should not be dry cleaned to avoid damage</div>
            </div>
        </div>
    </div>
</div>
