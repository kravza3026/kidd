@php
    $componentName = 'genders';
    $in_use = request()->has('filters') && (!request()->has('filters.gender.0') && array_key_exists('gender', request('filters')) ) ? count(request('filters')['gender']) : false;
    $filters= ['Size','Fabric type', 'Color','Gender','Season','Price','My Family'

]

@endphp

        <div class="relative flex justify-between items-center h-14 mb-4 border-b border-light-border p-4">
            <div class="flex items-center gap-x-2">
                <button type="button"  id="closeModal"  class="border border-light-border rounded-full flex items-center justify-center size-10">
                    <img class="rotate-180" src="{{ Vite::image('icons/right_arrow.svg') }}" alt="" />
                </button>
                <span class="text-black font font-bold text-2xl">Filter by</span>
            </div>
            <button type="button" class="flex items-center gap-x-2 top-2 right-3 text-black text-2xl border border-light-border rounded-full py-0 px-3">
                &times; <span class="text-sm">Clear filter</span>
            </button>
        </div>

        <div class="filter-group w-full space-y-4 grid bg-white ">
            <div class="w-full flex justify-between gap-x-2 border-b border-light-border pb-2 px-2">
                <p class="text-black font-medium">Size</p>
                <div class="flex gap-x-2 items-center">

                    <ul class="flex gap-x-2 text-olive font-medium">
                        <li>0-3M</li>
                        <li>3-6M</li>
                        <li>6-9M</li>
                    </ul>


                    <span> > </span>
                </div>
            </div>




            <div class="space-y-2" x-data>
                @foreach($filters as $filter)
                    <div
                        class="w-full flex justify-between gap-x-2 border-b border-light-border pb-2 px-2 cursor-pointer"
                        @click="$root.__x.$data.openModal('{{ strtolower($filter) }}')"
                    >
                        <p class="text-black font-medium">{{ $filter }}</p>
                        <div class="flex gap-x-2 items-center">
                            <p class="text-light-black/40">All {{ $filter }}s</p>
                            <img src="{{ Vite::image('icons/right_arrow.svg') }}" alt="→" />
                        </div>
                    </div>
                @endforeach
            </div>

        </div>


