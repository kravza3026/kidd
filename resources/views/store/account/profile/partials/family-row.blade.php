<div data-member-id="{{ $member->id }}">
<div class="w-full rounded-xl border border-gray-100 p-4">
    <div class="flex flex-col items-start gap-1">
        <div class="flex flex-1 w-full justify-between items-center">
            <div class="flex">
                <div class="size-9 flex items-center justify-center {{ $member->gender->id == 2 ? 'bg-baby-eyes' : 'bg-baby-pink' }} rounded-full">
                    {{--                        <img class="size-5 rounded-full" src="{{ Vite::image($member->gender->icon) }}" alt="{{ $member->gender->name }}">--}}
                    {!! $member->gender->svg !!}
                </div>
                <div class="ml-4 flex items-center">
                    <h3 class="text-lg leading-5 font-medium text-gray-900">
                        {{ $member->name }}
                    </h3>
                    <span class="inline-block mx-3 h-6 w-[1px] bg-gray-300/50"></span>
                    <span class="text-sm leading-5 font-light text-gray-400">
                        {{ $member->birth_date->diffForHumans(['parts' => 2, 'short'=> false, 'options' => Carbon\Carbon::SEQUENTIAL_PARTS_ONLY, 'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE]) }}
                    </span>
                </div>
            </div>
            <div class="flex gap-2">
                @can('update', $member)
                    <button
                        class="inline-flex items-center p-[7px] bg-white border border-darkest-snow rounded-full font-semibold text-xs text-olive tracking-widest hover:bg-dark-snow"
                        hx-get="{{ route('family.edit', $member) }}"
                        hx-target="closest div[data-member-id='{{ $member->id }}']"
                        hx-swap="outerHTML"
                    >
                        <img src="{{ Vite::image('common/edit.svg') }}" alt="">
                    </button>
                @endcan
                @can('delete', $member)
                    <button class="inline-flex items-center p-[7px] bg-white border border-darkest-snow rounded-full font-semibold text-xs text-olive tracking-widest hover:bg-dark-snow"
                            hx-trigger="click" hx-delete="{{ route('family.destroy', $member) }}">
                        <img src="{{ Vite::image('common/trash.svg') }}" alt="">
                    </button>
                @endcan
            </div>
        </div>

        <div class="flex gap-x-2 mt-3 flex-1 w-full items-center">
            <div class="text-charcoal border border-light-border py-1 px-3 rounded-lg">

                <div class="flex items-center gap-x-2 text-[14px] ">
                    <img src="{{ Vite::image('icons/date.png') }}" alt="date" class="opacity-50">
                    <p class="pt-1">{{ $member->birth_date->format('d M Y') }}</p>
                </div>
            </div>

            <div class="text-charcoal border border-light-border py-1 px-3 rounded-lg">
                <p class="text-sm text-[14px]">

                    {{ $member->gender->name }}
                </p>
            </div>
            <div class="text-charcoal border border-light-border py-1 px-3 rounded-lg">
                <p class="text-sm text-[14px]">
                    {{ $member->height }} <span class="text-charcoal/40">{{ __('general.cm') }}</span>
                </p>
            </div>

            <div class="text-charcoal border border-light-border py-1 px-3 rounded-lg">
                <p class="text-sm text-[14px]">
                    {{ $member->weight / 1000 }} <span class="text-charcoal/40">{{ __('general.kg') }}</span>
                </p>
            </div>
        </div>
    </div>
</div>
</div>
