<form class="w-full bg-white rounded-xl border border-gray-100 p-4" hx-post="{{ route('family.store') }}" hx-target="this" hx-swap="outerHTML">
    <div class="flex flex-col items-start gap-1">
        <div class="flex flex-1 w-full justify-between items-center">
            <div class="flex">
                <div class="size-9 flex items-center justify-center rounded-full">
                    <img src="{{ Vite::image('baby_unknown.svg') }}" alt="Gender icon"/>
                </div>
                <div class="ml-4 flex items-center">
                    <h3 class="text-lg leading-5 font-medium text-gray-900">
                        Name
                    </h3>
                </div>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="inline-flex gap-x-2 items-center px-3 py-2.5 bg-olive border border-darkest-snow rounded-full font-semibold text-xs text-snow tracking-widest hover:bg-dark-olive">
                    <img src="{{ Vite::image('check.png') }}" alt=""> Save
                </button>
                <button hx-on="click remove closest form" type="button" class="inline-flex items-center px-3 py-2.5 bg-white border border-darkest-snow rounded-full font-semibold text-xs text-olive
                tracking-widest hover:bg-dark-snow">
                    Cancel
                </button>
            </div>
        </div>
        <div class="flex mt-3 flex-1 w-full items-center">
            <div class="h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                <div class="w-4 h-4 relative opacity-40"></div>
                <div class="grow shrink basis-0 text-charcoal text-sm font-normal  leading-[14px]">
                    {{ \Illuminate\Support\Carbon::now()->format('d M Y') }}
                </div>
            </div>
            <div class="h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                <div class="grow shrink basis-0 text-charcoal text-sm font-normal  leading-[14px]">
                    Gender
                </div>
                <div class="w-4 h-4 relative opacity-40"></div>
            </div>
            <div class="w-[72px] h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                <div class="grow shrink basis-0"><span class="text-charcoal text-sm font-normal  leading-[14px]">
                        height
                    </span><span
                        class="text-charcoal/60 text-sm font-normal  leading-[14px]"> cm</span></div>
            </div>
            <div class="w-[72px] h-8 px-2.5 py-2 bg-white rounded-lg shadow border border-[#eeeeee] justify-start items-center gap-2 flex">
                <div class="grow shrink basis-0">
                    <span class="text-charcoal text-sm font-normal  leading-[14px]">
                        weight
                    </span>
                    <span class="text-charcoal/60 text-sm font-normal  leading-[14px]">
                        {{ __('general.kg') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</form>
