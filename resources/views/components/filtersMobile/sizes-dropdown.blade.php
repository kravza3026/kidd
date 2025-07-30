@php
    $componentName = 'sizes';
    $in_use = request()->has('filters') && (!request()->has('filters.size.0') && array_key_exists('size', request('filters')) ) ? count(request('filters')['size']) : false;
@endphp




        <div class="filter-group w-screen  grid space-y-[3px] z-[7000] left-0 bottom-0 px-2 bg-white">
            <label  for="filter_{{ $componentName }}_0"
                   class="cursor-pointer  flex justify-between px-3 py-2 w-full has-[:checked]:bg-secondary rounded-xl text-sm hover:bg-secondary focus:ring-secondary">
                <div class="inline-flex items-center">
                    <x-ui.checkbox
                        id="filter_{{ $componentName }}_0"
                        name="filters[size][]"
                        value="true"
                        :modelValue="request()->has('filters.size.0') || !request()->has('filters.size')"
                        class="rounded-full"
                    />

                    <span class="text-sm leading-4 -tracking-[2%] font-bold text-charcoal ms-2.5">А
                        {{ __('filters.all_sizes') }}
                    </span>
                </div>
                <span class="text-charcoal/40 -tracking-[2%] text-sm font-medium">
                                [{{ $sizes->sum('products_count') }}]
                            </span>
            </label>

            @foreach($sizes as $size)
                <label for="filter_{{ $componentName }}_{{ $size->id }}"
                       class="cursor-pointer  flex justify-between px-3 py-2 w-full has-[:checked]:bg-secondary rounded-xl text-sm hover:bg-secondary focus:ring-secondary">
                    <div class="inline-flex items-center">
                        <x-ui.checkbox
                            id="filter_{{ $componentName }}_{{ $size->id }}"
                            name="filters[size][{{ $size->id }}]"
                            value="true"
                            :modelValue="request()->has('filters.size.'.$size->id)"
                            class="rounded-full"
                        />


                        <span class="text-sm leading-4 -tracking-[2%] font-bold text-charcoal ms-2.5">
                            {{ $size->name }}
                        </span>
                    </div>
                    <span class="text-charcoal/40 -tracking-[2%] text-sm font-medium">
                        [{{ $size->products_count }}]
                    </span>
                </label>
            @endforeach

        </div>


