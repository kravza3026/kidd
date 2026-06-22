@props(['title' => null, 'description' => null])

<div {{ $attributes->merge(['class' => 'admin-card']) }}>
    @if ($title || $description || isset($actions))
        <div class="flex items-start justify-between gap-3 border-b border-line px-4 py-3">
            <div>
                @if ($title)
                    <h3 class="text-sm font-semibold text-ink">{{ $title }}</h3>
                @endif
                @if ($description)
                    <p class="mt-0.5 text-xs text-ink-muted">{{ $description }}</p>
                @endif
            </div>
            @isset($actions)
                <div class="flex items-center gap-2">{{ $actions }}</div>
            @endisset
        </div>
    @endif

    <div class="px-4 py-4">{{ $slot }}</div>
</div>
