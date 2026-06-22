@props([
    'wireModel',
    'label' => null,
    'required' => false,
    'textarea' => false,
    'rows' => 3,
])

@php($locales = array_keys(config('app.locales', ['ro' => 'Română', 'ru' => 'Русский', 'en' => 'English'])))

<div x-data="{ locale: @js($locales[0]) }" class="flex flex-col gap-1.5">
    <div class="flex items-center justify-between">
        @if ($label)
            <label class="admin-label">
                {{ $label }}
                @if ($required)
                    <span class="text-danger">*</span>
                @endif
            </label>
        @endif
        <div class="flex gap-1">
            @foreach ($locales as $loc)
                <button type="button" @click="locale = @js($loc)"
                    :class="locale === @js($loc) ? 'bg-olive text-white' : 'bg-surface-2 text-ink-muted'"
                    class="rounded-md px-2 py-0.5 text-xs font-semibold uppercase">{{ $loc }}</button>
            @endforeach
        </div>
    </div>

    @foreach ($locales as $loc)
        <div x-show="locale === @js($loc)" x-cloak>
            @if ($textarea)
                <textarea wire:model="{{ $wireModel }}.{{ $loc }}" rows="{{ $rows }}" {{ $attributes->merge(['class' => 'admin-input']) }}></textarea>
            @else
                <input type="text" wire:model="{{ $wireModel }}.{{ $loc }}" {{ $attributes->merge(['class' => 'admin-input']) }} />
            @endif
            @error("{$wireModel}.{$loc}")
                <p class="mt-1 text-xs text-danger">{{ $message }}</p>
            @enderror
        </div>
    @endforeach
</div>
