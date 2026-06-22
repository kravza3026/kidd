<div class="space-y-5">
    <x-admin.breadcrumbs :items="[['label' => __('Categories')]]" />

    <x-admin.page-header :title="__('Categories')" :subtitle="__('Manage storefront categories')">
        <x-slot:actions>
            @can('create', App\Models\Category::class)
                <x-admin.button :href="route('admin.categories.create')" wire:navigate>{{ __('New category') }}</x-admin.button>
            @endcan
        </x-slot:actions>
    </x-admin.page-header>

    <div class="admin-card overflow-hidden">
        {{-- Toolbar --}}
        <div class="flex items-center gap-2 border-b border-line p-2.5">
            <div class="relative max-w-xs flex-1">
                <svg viewBox="0 0 20 20" fill="currentColor" class="pointer-events-none absolute top-1/2 left-2.5 size-4 -translate-y-1/2 text-ink-muted">
                    <path d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
                <input type="search" wire:model.live.debounce.300ms="search" placeholder="{{ __('Search…') }}" class="admin-input pl-8" />
            </div>
            <span wire:loading.delay wire:target="search" class="text-xs text-ink-muted">{{ __('Searching…') }}</span>
            @if ($search !== '')
                <button type="button" wire:click="clearFilters" class="admin-btn admin-btn--ghost">{{ __('Clear') }}</button>
            @endif
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-line text-sm">
                <thead class="bg-surface-2 text-xs tracking-wide text-ink-muted uppercase">
                    <tr>
                        <x-admin.th field="name" :label="__('Name')" :sort-field="$sortField" :sort-direction="$sortDirection" />
                        <th class="admin-table-cell text-left font-medium">{{ __('Parent') }}</th>
                        <x-admin.th field="id" :label="__('ID')" :sort-field="$sortField" :sort-direction="$sortDirection" />
                        <th class="admin-table-cell text-left font-medium">{{ __('Products') }}</th>
                        <th class="admin-table-cell text-left font-medium">{{ __('Visible') }}</th>
                        <th class="admin-table-cell text-right font-medium">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse ($categories as $category)
                        <tr wire:key="cat-{{ $category->id }}" class="hover:bg-surface-2">
                            <td class="admin-table-cell font-medium text-ink">
                                <a href="{{ route('admin.categories.show', $category) }}" wire:navigate class="hover:text-olive">
                                    {{ $category->getTranslation('name', app()->getLocale()) }}
                                </a>
                            </td>
                            <td class="admin-table-cell text-ink-muted">{{ $category->parent?->getTranslation('name', app()->getLocale()) ?? '—' }}</td>
                            <td class="admin-table-cell text-ink-muted">{{ $category->id }}</td>
                            <td class="admin-table-cell text-ink-muted">{{ $category->products_count }}</td>
                            <td class="admin-table-cell">
                                <x-admin.status-badge
                                    :color="$category->is_visible ? 'green' : 'gray'"
                                    :label="$category->is_visible ? __('Visible') : __('Hidden')"
                                />
                            </td>
                            <td class="admin-table-cell">
                                <x-admin.row-actions :model="$category" :edit-url="route('admin.categories.edit', $category)" :delete-id="$category->id" :delete-confirm="__('Delete this category?')" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="admin-table-cell py-10 text-center text-ink-muted">
                                {{ __('No categories found.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-line p-2.5">
            {{ $categories->links() }}
        </div>
    </div>
</div>
