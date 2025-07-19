<form class="w-full rounded-xl border border-gray-100 p-4" hx-put="{{ route('family.update', $member) }}" hx-target="this" hx-swap="outerHTML">
    <div class="flex flex-col items-start gap-1">
        <div class="flex flex-1 w-full justify-between items-center">
            <div class="flex">
                <div class="size-9 flex items-center justify-center {{ $member->gender->id == 2 ? 'bg-baby-eyes' : 'bg-baby-pink' }} rounded-full">
                    {!! $member->gender->svg !!}
                </div>
                <div class="ml-4 flex items-center">
                    <h3 class="text-lg leading-5 font-medium text-gray-900">
                        {{ $member->name }}
                    </h3>
                    <span class="inline-block mx-3 h-6 w-[1px] bg-gray-300"></span>
                    <span class="text-base leading-5 font-normal text-gray-400">
                        {{ $member->birth_date->diffForHumans(['parts' => 2, 'short'=> false, 'options' => Carbon\Carbon::SEQUENTIAL_PARTS_ONLY, 'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE]) }}
                    </span>
                </div>
            </div>
            <div class="flex gap-2">
                <button class="inline-flex gap-x-2 items-center px-3 py-2.5 bg-olive border border-darkest-snow rounded-full font-semibold text-xs text-snow tracking-widest hover:bg-dark-olive">
                    <img src="{{ Vite::image('check.png') }}" alt=""> Save
                </button>
                <button class="inline-flex items-center px-3 py-2.5 bg-white border border-darkest-snow rounded-full font-semibold text-xs text-olive tracking-widest hover:bg-dark-snow"
                        hx-get="{{ route('family.show', $member) }}">
                    Cancel
                </button>
            </div>
        </div>
        <div class="flex mt-3 flex-1 w-full items-center">
            <div class="h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                <div class="w-4 h-4 relative opacity-40"></div>
                <div class="grow shrink basis-0 text-charcoal text-sm font-normal  leading-[14px]">
                    {{ $member->birth_date->format('d M Y') }}
                </div>
            </div>
            <div class="h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                <div class="grow shrink basis-0 text-charcoal text-sm font-normal  leading-[14px]">
                    {{ $member->gender->name }}
                </div>
                <div class="w-4 h-4 relative opacity-40"></div>
            </div>
            <div class="w-[72px] h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                <div class="grow shrink basis-0"><span class="text-charcoal text-sm font-normal  leading-[14px]">
                        {{ $member->height }}
                    </span><span
                        class="text-charcoal/60 text-sm font-normal  leading-[14px]"> cm</span></div>
            </div>
            <div class="w-[72px] h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                <div class="grow shrink basis-0">
                    <span class="text-charcoal text-sm font-normal  leading-[14px]">
                        {{ $member->weight / 1000 }}
                    </span>
                    <span class="text-charcoal/60 text-sm font-normal  leading-[14px]">
                        {{ __('general.kg') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</form>
