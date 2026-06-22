@props([
    'href' => null,
    'type' => 'submit',
    'variant' => 'primary',
])

@php
    $variants = [
        'primary' => 'admin-btn admin-btn--primary',
        'secondary' => 'admin-btn admin-btn--secondary',
        'danger' => 'admin-btn admin-btn--danger',
        'ghost' => 'admin-btn admin-btn--ghost',
    ];
    $classes = $variants[$variant] ?? $variants['primary'];
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif
