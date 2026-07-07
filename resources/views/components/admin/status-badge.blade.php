@props(['color' => 'gray', 'label' => null])

@php
    $palette = [
        'gray' => 'bg-surface-2 text-ink-muted',
        'green' => 'bg-olive/15 text-dark-olive dark:text-olive',
        'red' => 'bg-danger/10 text-danger',
        'yellow' => 'bg-amber-400/15 text-amber-600 dark:text-amber-400',
        'blue' => 'bg-sky-400/15 text-sky-600 dark:text-sky-400',
        'purple' => 'bg-purple-400/15 text-purple-600 dark:text-purple-400',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium '.($palette[$color] ?? $palette['gray'])]) }}>
    {{ $label ?? $slot }}
</span>
