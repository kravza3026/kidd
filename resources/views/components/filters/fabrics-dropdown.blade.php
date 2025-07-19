@php
    $componentName = 'fabrics';
    $in_use = request()->has('filters') && (!request()->has('filters.fabric.0') && array_key_exists('fabric', request('filters'))) ? count(request('filters')['fabric']) : false;
@endphp

<x-ui.dropdown class="" align="top" width="auto"
            trigger-classes="{{ $in_use ? 'bg-secondary border-darkest-snow border' : 'border border-transparent' }} px-3 py-2 rounded-full justify-center items-center gap-2 flex"
            content-classes="p-5 bg-white rounded-full min-w-[320px]">
    <x-slot name="trigger">
        <div class="cursor-pointer flex justify-start items-center gap-1 {{ $in_use ? 'text-olive font-extrabold' : 'text-black font-medium' }} text-sm leading-[14px]">
            {{ __('filters.fabric_type') }}
            @if($in_use)
                <div class="min-w-5 bg-olive py-0.5 px-1 rounded-xl justify-center items-center inline-flex shadow-md">
                    <div class="text-center text-white text-sm font-bold leading-none">
                        {{ $in_use }}
                    </div>
                </div>
            @endif
            <svg class="flex-shrink-0 size-4 text-black group-hover:rotate-180" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <path d="m6 9 6 6 6-6"/>
            </svg>
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="filter-group grid grid-cols-1 sm:grid-cols-2 gap-2">
            <label for="filter_{{ $componentName }}_0"
                   class="cursor-pointer flex flex-wrap h-[100px] w-[136px] rounded-xl pb-4 px-4 pt-3 text-sm bg-secondary border border-darkest-snow">
                <div class="w-full flex items-center justify-end">
                    <input name="filters[fabric][0]" value="true" type="checkbox"
                           class="checked:inline-flex hidden checked:visible filter-all border-darken p-[11px] rounded-full text-olive focus:ring-olive disabled:opacity-50 disabled:pointer-events-none"
                           id="filter_{{ $componentName }}_0"
                        @checked(request()->has('filters.fabric.0') || !request()->has('filters.fabric'))>
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
                       class="bg-black/25 bg-blend-multiply hover:bg-blend-lighten cursor-pointer flex flex-wrap h-[100px] w-[136px] rounded-xl pb-4 px-4 pt-3 text-sm bg-fill border focus:border-darkest-snow">
                    <div class="w-full flex items-center justify-end">
                        <input name="filters[fabric][{{ $fabric->id }}]" value="true" type="checkbox"
                               class="filter-option checked:inline-flex hidden checked:visible border-darken p-[11px] rounded-full text-olive focus:ring-olive disabled:opacity-50 disabled:pointer-events-none"
                               id="filter_{{ $componentName }}_{{ $fabric->id }}"
                            @checked(request()->has('filters.fabric.'.$fabric->id))>

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
    </x-slot>
</x-ui.dropdown>
