@props(['title' => null, 'description' => null])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-[#eeeeee] bg-white shadow-sm']) }}>
    @if ($title || $description || isset($actions))
        <div class="flex items-start justify-between gap-4 border-b border-[#f3f3f3] px-6 py-4">
            <div>
                @if ($title)
                    <h3 class="text-base font-semibold text-[#020202]">{{ $title }}</h3>
                @endif
                @if ($description)
                    <p class="mt-1 text-sm text-gray-500">{{ $description }}</p>
                @endif
            </div>
            @isset($actions)
                <div class="flex items-center gap-2">{{ $actions }}</div>
            @endisset
        </div>
    @endif

    <div class="px-6 py-5">{{ $slot }}</div>
</div>
