@php
    $in_use = (request()->has('filters.price.from') && !is_null(request()->get('filters')['price']['from'])) || (request()->has('filters.price.to') && !is_null(request()->get('filters')['price']['to'])) || request()->has('filters.price.discounted') && @request()->get('filters')['price']['discounted'];
@endphp

<div class="filter-group grid">
    <div class="px-2 w-full space-y-3">
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

                <x-ui.checkbox
                    id="filter_{{ $componentName }}_{{ $size->id }}"
                    id="filter_price_discounted"
                    value="true"
                    name="filters[price][discounted]"
                    :modelValue="request()->has('filters.price.discounted')"

                />
                <span class="text-sm leading-4 -tracking-[2%] font-bold text-charcoal ms-2.5">
                        {{ __('filters.price_discounted') }}
                    </span>
            </div>
        </label>
    </div>

</div>
