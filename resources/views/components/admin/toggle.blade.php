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
        <span class="h-6 w-11 rounded-full bg-gray-200 transition peer-checked:bg-charcoal"></span>
        <span class="absolute left-0.5 top-0.5 h-5 w-5 rounded-full bg-white shadow transition peer-checked:translate-x-5"></span>
    </span>
    @if ($label)
        <span class="text-sm text-gray-700">{{ $label }}</span>
    @endif
</label>
