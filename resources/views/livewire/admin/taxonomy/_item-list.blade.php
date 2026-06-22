{{-- A drag-sortable list of taxonomy items for one group ($list, $groupId). --}}
@php($sortable = ! $searching && $supportsGroups)
<ul
    @if ($sortable) wire:sort="reorderItem" wire:sort:group="{{ $resource }}-items" wire:sort:group-id="{{ $groupId }}" @endif
    class="min-h-[2.5rem] divide-y divide-line"
>
    @forelse ($list as $item)
        <li wire:key="item-{{ $item->id }}" @if ($sortable) wire:sort:item="{{ $item->id }}" @endif class="flex items-center gap-3 py-2">
            @if ($sortable)
                <span wire:sort:handle class="cursor-grab text-ink-subtle hover:text-ink-muted">
                    <svg viewBox="0 0 20 20" fill="currentColor" class="size-4"><path d="M7 4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM7 10a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM6 17a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM15 4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM14 11a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM15 16a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" /></svg>
                </span>
            @endif

            <span class="flex-1 truncate text-sm font-medium text-ink">{{ $item->getTranslation($labelAttribute, app()->getLocale()) }}</span>

            @foreach ($columns as $col)
                <span class="hidden text-xs text-ink-muted sm:inline">{{ $col['value']($item) }}</span>
            @endforeach

            <div wire:sort:ignore class="flex items-center gap-1">
                @can("{$resource}.update")
                    <a href="{{ route($routePrefix.'.edit', $item->id) }}" wire:navigate class="admin-btn admin-btn--ghost">{{ __('Edit') }}</a>
                @endcan
                @can("{$resource}.delete")
                    <button type="button" wire:click="delete({{ $item->id }})" wire:confirm="{{ __('Delete this item?') }}" class="admin-btn admin-btn--ghost text-danger hover:bg-danger/10">{{ __('Delete') }}</button>
                @endcan
            </div>
        </li>
    @empty
        <li class="py-3 text-center text-xs text-ink-muted">{{ __('Drag items here or nothing yet.') }}</li>
    @endforelse
</ul>
