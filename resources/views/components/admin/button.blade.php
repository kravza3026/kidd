@props([
    'href' => null,
    'type' => 'submit',
    'variant' => 'primary',
])

@php
    $variants = [
        'primary' => 'bg-charcoal text-white hover:bg-black',
        'secondary' => 'border border-[#eeeeee] bg-white text-charcoal hover:bg-gray-50',
        'danger' => 'bg-red-600 text-white hover:bg-red-700',
    ];
    $classes = 'inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold transition '.($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif
