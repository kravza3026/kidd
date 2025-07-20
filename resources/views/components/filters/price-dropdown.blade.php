@php
    $in_use = (request()->has('filters.price.from') && !is_null(request()->get('filters')['price']['from'])) || (request()->has('filters.price.to') && !is_null(request()->get('filters')['price']['to'])) || request()->has('filters.price.discounted') && @request()->get('filters')['price']['discounted'];
@endphp

<x-ui.dropdown class="" align="top" width="w-size"
            trigger-classes="{{ $in_use ? 'bg-secondary border-darkest-snow border' : 'border border-transparent' }} px-3 py-2 rounded-full justify-center items-center gap-2 flex"
            content-classes="p-5 bg-white rounded-full">
    <x-slot name="trigger">
        <div class="cursor-pointer flex justify-start items-center gap-1 {{ $in_use ? 'text-olive font-extrabold' : 'text-black font-medium' }} text-sm leading-[14px]">
            {{ __('filters.price') }}
            <svg class="flex-shrink-0 size-4 text-black group-hover:rotate-180" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <path d="m6 9 6 6 6-6"/>
            </svg>
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="filter-group grid">
            <div class="max-w-xs w-full space-y-3">
                <div>
                    <label for="filter_price_from" class="block mb-3 font-bold text-sm leading-4">
                        From
                    </label>
                    <div class="relative">
                        <input type="text" id="filter_price_from" name="filters[price][from]"
                               class="py-5 px-5 pe-12 block w-full border-[1.5px] border-darkest-snow shadow-sm rounded-xl text-sm leading-4 font-bold text-charcoal placeholder:text-charcoal/50 focus:z-10"
                               placeholder="0" value="{{ request()->has('filters.price.from') ? request()->get('filters')['price']['from'] : '' }}">
                        <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-5">
                            <span class="text-charcoal/50">lei</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="filter_price_to" class="block mb-3 font-bold text-sm leading-4">
                        To
                    </label>
                    <div class="relative">
                        <input type="text" id="filter_price_to" name="filters[price][to]"
                               class="py-5 px-5 pe-12 block w-full border-[1.5px] border-darkest-snow shadow-sm rounded-xl text-sm leading-4 font-bold text-charcoal placeholder:text-charcoal/50 focus:z-10"
                               placeholder="9999" value="{{ request()->has('filters.price.to') ? request()->get('filters')['price']['to'] : '' }}">
                        <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-5">
                            <span class="text-charcoal/50">lei</span>
                        </div>
                    </div>
                </div>

                <label for="filter_price_discounted"
                       class="cursor-pointer flex justify-between w-full text-sm">
                    <div class="inline-flex items-center">
                        <input name="filters[price][discounted]" value="true" type="checkbox"
                               class="rounded-md w-5 h-5 text-charcoal checked:text-olive"
                               id="filter_price_discounted"
                            @checked( request()->has('filters.price.discounted') )>
                        <span class="text-sm leading-4 -tracking-[2%] font-bold text-charcoal ms-2.5">
                        {{ __('filters.price_discounted') }}
                    </span>
                    </div>
                </label>
            </div>

        </div>
    </x-slot>
</x-ui.dropdown>
