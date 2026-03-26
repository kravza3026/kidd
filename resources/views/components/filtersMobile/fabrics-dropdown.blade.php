@php
    $componentName = 'fabrics';
    $in_use = request()->has('filters') && (!request()->has('filters.fabric.0') && array_key_exists('fabric', request('filters'))) ? count(request('filters')['fabric']) : false;
@endphp

<div class="filter-group flex flex-wrap w-full justify-center sm:grid-cols-2 gap-2">
    <label for="filter_{{ $componentName }}_0"
           class="cursor-pointer flex flex-wrap h-[100px] w-[136px] mx-auto rounded-xl pb-4 px-4 pt-3 text-sm bg-secondary border border-darkest-snow">
        <div class="w-full flex items-center justify-end">
            <x-ui.checkbox
                id="filter_{{ $componentName }}_0"
                name="filters[fabric][0]"
                value="true"
                :modelValue="request()->has('filters.fabric.0') || !request()->has('filters.fabric')"
                class="rounded-full"
            />


        </div>
        <div class="w-full flex items-end">
            <div class="flex items-center gap-x-1">
                        <span class="text-wrap text-sm leading-4 -tracking-[2%] font-bold text-charcoal -ms-1">
                            {{ __('filters.all_fabric_types') }}
                        </span>
                <span class="text-charcoal/40 -tracking-[2%] text-sm font-medium">
                            [{{ $fabrics->sum('products_count') }}]
                        </span>
            </div>
        </div>
    </label>

    @foreach($fabrics as $fabric)
        <label for="filter_{{ $componentName }}_{{ $fabric->id }}"
               style="background-image: url('{{ Vite::image('fabrics/'.$fabric->image_path) }}'); background-blend-mode: darken; background-size: cover;"
               class="bg-black/25 bg-blend-multiply hover:bg-blend-lighten cursor-pointer mx-auto flex flex-wrap h-[100px] w-[136px] rounded-xl pb-4 px-4 pt-3 text-sm bg-fill border focus:border-darkest-snow">
            <div class="w-full flex items-center justify-end">
                <x-ui.checkbox
                    id="filter_{{ $componentName }}_{{ $fabric->id }}"
                    name="filters[fabric][{{ $fabric->id }}]"
                    value="true"
                    :modelValue="request()->has('filters.fabric.'.$fabric->id)"
                    class="rounded-full"
                />
            </div>
            <div class="w-full flex items-end">
                <div class="flex items-center gap-x-1">
                        <span class="text-wrap text-sm leading-4 -tracking-[2%] font-bold text-secondary -ms-1">
                            {{ $fabric->name }}
                        </span>
                    <span class="text-secondary/65 shadow-sm -tracking-[2%] text-sm font-medium">
                            [{{ $fabric->products_count }}]
                        </span>
                </div>
            </div>
        </label>
    @endforeach
</div>
