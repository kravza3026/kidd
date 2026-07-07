@props(['name', 'value' => 0, 'currency' => 'MDL'])

@php
    $amount = match (true) {
        $value instanceof \Money\Money => ((int) $value->getAmount()) / 100,
        is_numeric($value) => $value / 100,
        default => 0,
    };
@endphp

<div class="relative">
    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-xs font-semibold text-ink-muted">
        {{ $currency }}
    </span>
    <input
        type="number"
        step="0.01"
        min="0"
        name="{{ $name }}"
        value="{{ old($name, number_format($amount, 2, '.', '')) }}"
        {{ $attributes->merge(['class' => 'admin-input pl-12']) }}
    />
</div>
