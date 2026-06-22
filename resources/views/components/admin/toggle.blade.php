@props(['name', 'checked' => false, 'label' => null])

<label class="flex cursor-pointer items-center gap-3">
    {{-- Ensures a value is always submitted, even when unchecked. --}}
    <input type="hidden" name="{{ $name }}" value="0" />
    <span class="relative inline-flex">
        <input
            type="checkbox"
            name="{{ $name }}"
            value="1"
            @checked(old($name, $checked))
            {{ $attributes->merge(['class' => 'peer sr-only']) }}
        />
        <span class="h-5 w-9 rounded-full bg-line transition peer-checked:bg-olive"></span>
        <span class="absolute top-0.5 left-0.5 h-4 w-4 rounded-full bg-white shadow transition peer-checked:translate-x-4"></span>
    </span>
    @if ($label)
        <span class="text-sm text-ink">{{ $label }}</span>
    @endif
</label>
