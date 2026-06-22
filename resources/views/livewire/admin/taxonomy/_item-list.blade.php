{{-- A sortable <tbody> of taxonomy rows for one group ($list, $groupId). Rendered inside
     the shared table in grouped.blade.php so columns line up with the single header. --}}
@php($sortable = ! $searching && $supportsGroups)
@php($span = count($columns) + 3)
<tbody
    @if ($sortable) wire:sort="reorderItem" wire:sort:group="{{ $resource }}-items" wire:sort:group-id="{{ $groupId }}" @endif
    class="divide-y divide-line"
>
    @forelse ($list as $item)
        <tr wire:key="item-{{ $item->id }}" @if ($sortable) wire:sort:item="{{ $item->id }}" @endif class="hover:bg-surface-2">
            <td class="admin-table-cell w-8">
                @if ($sortable)
                    <span wire:sort:handle class="cursor-grab text-ink-subtle hover:text-ink-muted">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="size-4"><path d="M7 4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM7 10a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM6 17a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM15 4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM14 11a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM15 16a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" /></svg>
                    </span>
                @endif
            </td>
            <td class="admin-table-cell font-medium text-ink">{{ $item->getTranslation($labelAttribute, app()->getLocale()) }}</td>
            @foreach ($columns as $col)
                <td class="admin-table-cell text-ink-muted">{{ $col['value']($item) }}</td>
            @endforeach
            <td class="admin-table-cell" wire:sort:ignore>
                <x-admin.row-actions :resource="$resource" :edit-url="route($routePrefix.'.edit', $item->id)" :delete-id="$item->id" />
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="{{ $span }}" class="admin-table-cell py-3 text-center text-xs text-ink-muted">{{ __('Drag items here or nothing yet.') }}</td>
        </tr>
    @endforelse
</tbody>
