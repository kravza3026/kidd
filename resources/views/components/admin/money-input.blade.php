@props(['name', 'value' => 0, 'currency' => 'MDL'])

@php
    // Accepts a Money instance, a minor-unit integer, or null — displays major units.
    $amount = match (true) {
        $value instanceof \Money\Money => ((int) $value->getAmount()) / 100,
        is_numeric($value) => $value / 100,
        default => 0,
    };
@endphp

<div class="relative">
    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-sm text-gray-400">
        {{ $currency }}
    </span>
    <input
        type="number"
        step="0.01"
        min="0"
        name="{{ $name }}"
        value="{{ old($name, number_format($amount, 2, '.', '')) }}"
        {{ $attributes->merge(['class' => 'w-full rounded-xl border-[1.5px] border-[#eeeeee] py-3 pl-14 pr-3 text-base leading-tight text-charcoal focus:border-gray-200 focus:ring-gray-200']) }}
    />
</div>
