<div class="space-y-5">
    <x-admin.breadcrumbs :items="[['label' => __('Inventory')]]" />

    <x-admin.page-header :title="__('Inventory')" :subtitle="__('Stock levels per variant across warehouses')" />

    <div class="admin-card overflow-hidden">
        <div class="flex flex-wrap items-center gap-3 border-b border-line p-2.5">
            <div class="relative max-w-xs flex-1">
                <svg viewBox="0 0 20 20" fill="currentColor" class="pointer-events-none absolute top-1/2 left-2.5 size-4 -translate-y-1/2 text-ink-muted">
                    <path d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
                <input type="search" wire:model.live.debounce.300ms="search" placeholder="{{ __('Search SKU, barcode, product…') }}" class="admin-input pl-8" />
            </div>
            <label class="flex cursor-pointer items-center gap-2 text-sm text-ink-muted">
                <input type="checkbox" wire:model.live="lowStockOnly" class="size-4 accent-olive" />
                {{ __('Low stock only') }}
            </label>
            <span wire:loading.delay class="text-xs text-ink-muted">{{ __('Loading…') }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-line text-sm">
                <thead class="bg-surface-2 text-xs tracking-wide text-ink-muted uppercase">
                    <tr>
                        <th class="admin-table-cell text-left font-medium">{{ __('Product name') }}</th>
                        <th class="admin-table-cell text-left font-medium">{{ __('Variant') }}</th>
                        <x-admin.th field="sku" :label="__('SKU')" :sort-field="$sortField" :sort-direction="$sortDirection" />
                        <th class="admin-table-cell text-left font-medium">{{ __('Barcode') }}</th>
                        <x-admin.th field="quantity" :label="__('In stock')" :sort-field="$sortField" :sort-direction="$sortDirection" />
                        <th class="admin-table-cell text-right font-medium">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse ($rows as $variant)
                        <tr wire:key="inv-{{ $variant->id }}" class="hover:bg-surface-2">
                            <td class="admin-table-cell text-ink">{{ $variant->product?->getTranslation('name', $locale) ?? '—' }}</td>
                            <td class="admin-table-cell text-ink-muted">{{ $variant->color?->getTranslation('name', $locale) }} · {{ $variant->size?->getTranslation('name', $locale) }}</td>
                            <td class="admin-table-cell font-mono text-xs text-ink-muted">{{ $variant->sku ?? '—' }}</td>
                            <td class="admin-table-cell font-mono text-xs text-ink-muted">{{ $variant->barcode ?? '—' }}</td>
                            <td class="admin-table-cell">
                                <span @class([
                                    'inline-flex items-center rounded-full px-2 py-0.5 text-xs font-semibold',
                                    'bg-danger/10 text-danger' => $variant->quantity <= $threshold,
                                    'bg-olive/15 text-dark-olive dark:text-olive' => $variant->quantity > $threshold,
                                ])>{{ $variant->quantity }}</span>
                            </td>
                            <td class="admin-table-cell text-right">
                                @can('inventory.update')
                                    <a href="{{ route('admin.inventory.show', $variant->id) }}" wire:navigate title="{{ __('Manage stock') }}" aria-label="{{ __('Manage stock') }}" class="admin-icon-btn ml-auto">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="size-4">
                                            <path d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="admin-table-cell py-10 text-center text-ink-muted">{{ __('No variants found.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-line p-2.5">{{ $rows->links() }}</div>
    </div>
</div>
