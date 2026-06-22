<div class="space-y-5">
    <x-admin.breadcrumbs :items="[['label' => $title]]" />

    <x-admin.page-header :title="$title">
        <x-slot:actions>
            @if (\Illuminate\Support\Facades\Route::has($routePrefix.'.create') && auth()->user()?->can($resource.'.create'))
                <x-admin.button :href="route($routePrefix.'.create')" wire:navigate>{{ __('New') }}</x-admin.button>
            @endif
        </x-slot:actions>
    </x-admin.page-header>

    <div class="admin-card overflow-hidden">
        <div class="flex items-center gap-2 border-b border-line p-2.5">
            <div class="relative max-w-xs flex-1">
                <svg viewBox="0 0 20 20" fill="currentColor" class="pointer-events-none absolute top-1/2 left-2.5 size-4 -translate-y-1/2 text-ink-muted">
                    <path d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
                <input type="search" wire:model.live.debounce.300ms="search" placeholder="{{ __('Search…') }}" class="admin-input pl-8" />
            </div>
            <span wire:loading.delay wire:target="search" class="text-xs text-ink-muted">{{ __('Searching…') }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-line text-sm">
                <thead class="bg-surface-2 text-xs tracking-wide text-ink-muted uppercase">
                    <tr>
                        <x-admin.th :field="$labelAttribute" :label="$labelHeading" :sort-field="$sortField" :sort-direction="$sortDirection" />
                        @foreach ($columns as $col)
                            <th class="admin-table-cell text-left font-medium">{{ $col['label'] }}</th>
                        @endforeach
                        <th class="admin-table-cell text-right font-medium">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse ($rows as $row)
                        <tr wire:key="tax-{{ $row->id }}" class="hover:bg-surface-2">
                            <td class="admin-table-cell font-medium text-ink">{{ $row->getTranslation($labelAttribute, app()->getLocale()) }}</td>
                            @foreach ($columns as $col)
                                <td class="admin-table-cell text-ink-muted">{{ $col['value']($row) }}</td>
                            @endforeach
                            <td class="admin-table-cell">
                                <x-admin.row-actions :resource="$resource" :edit-url="route($routePrefix.'.edit', $row->id)" :delete-id="$row->id" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($columns) + 2 }}" class="admin-table-cell py-10 text-center text-ink-muted">{{ __('Nothing here yet.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-line p-2.5">{{ $rows->links() }}</div>
    </div>
</div>
