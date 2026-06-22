<div class="space-y-5">
    <x-admin.breadcrumbs :items="[['label' => __('Products')]]" />

    <x-admin.page-header :title="__('Products')" :subtitle="__('Manage the product catalog')">
        <x-slot:actions>
            @can('create', App\Models\Product::class)
                <x-admin.button :href="route('admin.products.create')" wire:navigate>{{ __('New product') }}</x-admin.button>
            @endcan
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
            @if ($search !== '')
                <button type="button" wire:click="clearFilters" class="admin-btn admin-btn--ghost">{{ __('Clear') }}</button>
            @endif
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-line text-sm">
                <thead class="bg-surface-2 text-xs tracking-wide text-ink-muted uppercase">
                    <tr>
                        <x-admin.th field="name" :label="__('Name')" :sort-field="$sortField" :sort-direction="$sortDirection" />
                        <th class="admin-table-cell text-left font-medium">{{ __('Category') }}</th>
                        <th class="admin-table-cell text-left font-medium">{{ __('Variants') }}</th>
                        <th class="admin-table-cell text-left font-medium">{{ __('Flags') }}</th>
                        <th class="admin-table-cell text-left font-medium">{{ __('Visible') }}</th>
                        <th class="admin-table-cell text-right font-medium">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse ($products as $product)
                        <tr wire:key="prod-{{ $product->id }}" class="hover:bg-surface-2">
                            <td class="admin-table-cell font-medium text-ink">
                                <a href="{{ route('admin.products.show', $product) }}" wire:navigate class="hover:text-olive">
                                    {{ $product->getTranslation('name', app()->getLocale()) }}
                                </a>
                            </td>
                            <td class="admin-table-cell text-ink-muted">{{ $product->category?->getTranslation('name', app()->getLocale()) ?? '—' }}</td>
                            <td class="admin-table-cell text-ink-muted">{{ $product->variants_count }}</td>
                            <td class="admin-table-cell">
                                <div class="flex flex-wrap gap-1">
                                    @if ($product->is_new)<x-admin.status-badge color="blue" :label="__('New')" />@endif
                                    @if ($product->is_featured)<x-admin.status-badge color="purple" :label="__('Featured')" />@endif
                                    @if ($product->has_discount)<x-admin.status-badge color="red" :label="__('Sale')" />@endif
                                    @if ($product->is_bestseller)<x-admin.status-badge color="yellow" :label="__('Best')" />@endif
                                </div>
                            </td>
                            <td class="admin-table-cell">
                                <x-admin.status-badge :color="$product->is_visible ? 'green' : 'gray'" :label="$product->is_visible ? __('Visible') : __('Hidden')" />
                            </td>
                            <td class="admin-table-cell">
                                <x-admin.row-actions :model="$product" :edit-url="route('admin.products.edit', $product)" :delete-id="$product->id" :delete-confirm="__('Delete this product?')" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="admin-table-cell py-10 text-center text-ink-muted">{{ __('No products found.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-line p-2.5">{{ $products->links() }}</div>
    </div>
</div>
