<div hx-target="this" hx-swap="outerHTML" class="w-full rounded-xl border border-gray-100 p-4">
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
                    <span class="inline-block mx-3 h-6 w-[1px] bg-gray-300"></span>
                    <span class="text-base leading-5 font-normal text-gray-400">
                        {{ $member->birth_date->diffForHumans(['parts' => 2, 'short'=> false, 'options' => Carbon\Carbon::SEQUENTIAL_PARTS_ONLY, 'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE]) }}
                    </span>
                </div>
            </div>
            <div class="flex gap-2">
                @can('update', $member)
                    <button class="inline-flex items-center px-3 py-2.5 bg-white border border-darkest-snow rounded-full font-semibold text-xs text-olive tracking-widest hover:bg-dark-snow"
                            hx-trigger="click" hx-get="{{ route('family.edit', $member) }}">
                        <img src="{{ Vite::image('edit.png') }}" alt="">
                    </button>
                @endcan
                @can('delete', $member)
                    <button class="inline-flex items-center px-3 py-2.5 bg-white border border-darkest-snow rounded-full font-semibold text-xs text-olive tracking-widest hover:bg-dark-snow"
                            hx-trigger="click" hx-delete="{{ route('family.destroy', $member) }}">
                        <img src="{{ Vite::image('trash.png') }}" alt="">
                    </button>
                @endcan
            </div>
        </div>

        <div class="flex mt-3 flex-1 w-full items-center">
            <div class="text-charcoal">
                <p class="font-medium text-gray-500">
                    {{ $member->birth_date->format('d M Y') }}
                </p>
            </div>

            <div class="text-charcoal">
                <p class="text-sm font-medium text-gray-500">
                    {{ $member->gender->name }}
                </p>
            </div>
            <div class="text-charcoal">
                <p class="text-sm font-medium text-gray-500">
                    {{ $member->height }} {{ __('general.cm') }}
                </p>
            </div>

            <div class="text-charcoal">
                <p class="text-sm font-medium text-gray-500">
                    {{ $member->weight / 1000 }} {{ __('general.kg') }}
                </p>
            </div>
        </div>
    </div>
</div>
