@props([
    'route',
    'label',
    'icon' => null,
    'permission' => null,
    'feature' => null,
    'params' => [],
])

@php
    $routeExists = \Illuminate\Support\Facades\Route::has($route);
    $allowed = ! $permission || (auth()->user()?->can($permission) ?? false);
    $enabled = ! $feature || \Laravel\Pennant\Feature::active($feature);
    $visible = $routeExists && $allowed && $enabled;

    $wildcard = \Illuminate\Support\Str::beforeLast($route, '.').'.*';
    $active = request()->routeIs($route) || request()->routeIs($wildcard);
@endphp

@if ($visible)
    <a
        href="{{ route($route, $params) }}"
        wire:navigate
        @class([
            'group flex items-center gap-x-3 rounded-lg px-2.5 py-2 text-sm font-medium transition-colors',
            'bg-olive-soft text-dark-olive dark:text-olive' => $active,
            'text-ink-muted hover:bg-surface-2 hover:text-ink' => ! $active,
        ])
        @if ($active) aria-current="page" @endif
    >
        @if ($icon)
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"
                @class([
                    'size-5 shrink-0',
                    'text-olive' => $active,
                    'text-ink-muted group-hover:text-ink' => ! $active,
                ])>
                <path d="{{ $icon }}" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        @endif
        <span x-show="!collapsed" class="truncate">{{ $label }}</span>
    </a>
@endif
