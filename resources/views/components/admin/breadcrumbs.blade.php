@props(['items' => []])

{{-- $items: list of ['label' => string, 'route' => ?string, 'params' => array]. Last item is current. --}}
<nav aria-label="Breadcrumb" {{ $attributes->merge(['class' => 'flex items-center gap-1.5 text-xs text-ink-muted']) }}>
    <a href="{{ route('admin.home') }}" wire:navigate class="hover:text-ink">{{ __('Home') }}</a>
    @foreach ($items as $item)
        <svg viewBox="0 0 20 20" fill="currentColor" class="size-3.5 text-ink-subtle">
            <path d="M7.21 14.77a.75.75 0 0 1 .02-1.06L11.168 10 7.23 6.29a.75.75 0 1 1 1.04-1.08l4.5 4.25a.75.75 0 0 1 0 1.08l-4.5 4.25a.75.75 0 0 1-1.06-.02Z" clip-rule="evenodd" fill-rule="evenodd" />
        </svg>
        @if (! $loop->last && ! empty($item['route']))
            <a href="{{ route($item['route'], $item['params'] ?? []) }}" wire:navigate class="hover:text-ink">{{ $item['label'] }}</a>
        @else
            <span @class(['text-ink font-medium' => $loop->last])>{{ $item['label'] }}</span>
        @endif
    @endforeach
</nav>
