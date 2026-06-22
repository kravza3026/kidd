<div class="space-y-5">
    <x-admin.breadcrumbs :items="[['label' => $title]]" />

    <x-admin.page-header :title="$title">
        <x-slot:actions>
            @can("{$resource}.update")
                <x-admin.button type="button" variant="ghost" wire:click="$toggle('managingGroups')">
                    {{ $managingGroups ? __('Done') : __('Manage groups') }}
                </x-admin.button>
            @endcan
            @if (\Illuminate\Support\Facades\Route::has($routePrefix.'.create') && auth()->user()?->can($resource.'.create'))
                <x-admin.button :href="route($routePrefix.'.create')" wire:navigate>{{ __('New') }}</x-admin.button>
            @endif
        </x-slot:actions>
    </x-admin.page-header>

    {{-- Group management --}}
    @if ($managingGroups)
        <x-admin.card :title="__('Groups')" :description="__('Add, rename, reorder or remove groups. Drag the handle to reorder.')">
            <form wire:submit="saveGroups" class="space-y-3">
                <ul wire:sort="reorderGroup" class="space-y-2">
                    @forelse ($groups as $group)
                        <li wire:key="grp-{{ $group->id }}" wire:sort:item="{{ $group->id }}" class="flex items-center gap-2 rounded-lg border border-line bg-surface px-2 py-2">
                            <span wire:sort:handle class="cursor-grab text-ink-subtle hover:text-ink-muted">
                                <svg viewBox="0 0 20 20" fill="currentColor" class="size-4"><path d="M7 4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM7 10a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM6 17a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM15 4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM14 11a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM15 16a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" /></svg>
                            </span>
                            <div class="grid flex-1 gap-1.5 sm:grid-cols-3">
                                @foreach ($locales as $loc)
                                    <div class="relative">
                                        <span class="pointer-events-none absolute top-1/2 left-2 -translate-y-1/2 text-[10px] font-semibold text-ink-subtle uppercase">{{ $loc }}</span>
                                        <input type="text" wire:model="groupNames.{{ $group->id }}.{{ $loc }}" class="admin-input pl-8 text-sm" />
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" wire:sort:ignore wire:click="deleteGroup({{ $group->id }})" wire:confirm="{{ __('Delete this group? Its items become ungrouped.') }}" class="admin-btn admin-btn--ghost text-danger hover:bg-danger/10">{{ __('Delete') }}</button>
                        </li>
                    @empty
                        <li class="py-2 text-center text-sm text-ink-muted">{{ __('No groups yet.') }}</li>
                    @endforelse
                </ul>
                <div class="flex items-center gap-2">
                    <x-admin.button type="submit">{{ __('Save groups') }}</x-admin.button>
                    <x-admin.button type="button" variant="secondary" wire:click="addGroup">{{ __('Add group') }}</x-admin.button>
                </div>
            </form>
        </x-admin.card>
    @endif

    {{-- Search --}}
    <div class="relative max-w-xs">
        <svg viewBox="0 0 20 20" fill="currentColor" class="pointer-events-none absolute top-1/2 left-2.5 size-4 -translate-y-1/2 text-ink-muted">
            <path d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" fill-rule="evenodd" />
        </svg>
        <input type="search" wire:model.live.debounce.300ms="search" placeholder="{{ __('Search…') }}" class="admin-input pl-8" />
    </div>

    @if ($searching)
        <p class="text-xs text-ink-muted">{{ __('Reordering is disabled while searching.') }}</p>
    @endif

    {{-- Grouped, drag-sortable items --}}
    @php($ungrouped = $items->whereNull('attribute_group_id'))
    <div class="space-y-4">
        @foreach ($groups as $group)
            <x-admin.card :title="$group->getTranslation('name', app()->getLocale())">
                @include('livewire.admin.taxonomy._item-list', ['list' => $items->where('attribute_group_id', $group->id), 'groupId' => $group->id])
            </x-admin.card>
        @endforeach

        <x-admin.card :title="$groups->isNotEmpty() ? __('Ungrouped') : null">
            @include('livewire.admin.taxonomy._item-list', ['list' => $ungrouped, 'groupId' => ''])
        </x-admin.card>
    </div>
</div>
