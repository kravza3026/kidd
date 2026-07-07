@props(['wireModel', 'label' => null, 'hint' => null])

<label class="flex cursor-pointer items-center justify-between gap-3 py-1">
    <span class="flex flex-col">
        @if ($label)
            <span class="text-sm text-ink">{{ $label }}</span>
        @endif
        @if ($hint)
            <span class="text-xs text-ink-muted">{{ $hint }}</span>
        @endif
    </span>
    <span class="relative inline-flex shrink-0">
        <input type="checkbox" wire:model="{{ $wireModel }}" {{ $attributes->merge(['class' => 'peer sr-only']) }} />
        <span class="h-5 w-9 rounded-full bg-line transition peer-checked:bg-olive"></span>
        <span class="pointer-events-none absolute top-0.5 left-0.5 h-4 w-4 rounded-full bg-white shadow transition peer-checked:translate-x-4"></span>
    </span>
</label>
