@props(['label' => null, 'name' => null, 'required' => false, 'hint' => null])

@php($fieldError = $name ? $errors->first($name) : null)

<div {{ $attributes->only('class')->merge(['class' => 'flex flex-col gap-1.5']) }}>
    @if ($label)
        <x-input-label>
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </x-input-label>
    @endif

    {{ $slot }}

    @if ($hint)
        <p class="text-xs text-gray-400">{{ $hint }}</p>
    @endif

    @if ($fieldError)
        <p class="text-sm text-red-600">{{ $fieldError }}</p>
    @endif
</div>
