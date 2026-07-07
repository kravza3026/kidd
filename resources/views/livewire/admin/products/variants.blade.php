<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Products'), 'route' => 'admin.products.index'],
        ['label' => $product->getTranslation('name', app()->getLocale()), 'route' => 'admin.products.show', 'params' => $product->id],
        ['label' => __('Variant matrix')],
    ]" />

    <x-admin.page-header :title="__('Variant matrix')" :subtitle="$product->getTranslation('name', app()->getLocale())">
        <x-slot:actions>
            <x-admin.button :href="route('admin.products.show', $product->id)" wire:navigate variant="secondary">{{ __('Back') }}</x-admin.button>
        </x-slot:actions>
    </x-admin.page-header>

    {{-- Combo pickers --}}
    <x-admin.card :title="__('Generate combinations')" :description="__('Pick colours and sizes, then generate the matrix. Existing rows are preserved.')">
        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <span class="admin-label mb-2 block">{{ __('Colours') }}</span>
                <div class="flex flex-wrap gap-1.5">
                    @foreach ($colors as $id => $label)
                        <label class="cursor-pointer">
                            <input type="checkbox" wire:model="selectedColors" value="{{ $id }}" class="peer sr-only" />
                            <span class="inline-flex rounded-full border border-line px-3 py-1 text-xs text-ink-muted peer-checked:border-olive peer-checked:bg-olive-soft peer-checked:text-dark-olive">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div>
                <span class="admin-label mb-2 block">{{ __('Sizes') }}</span>
                <div class="flex flex-wrap gap-1.5">
                    @foreach ($sizes as $id => $label)
                        <label class="cursor-pointer">
                            <input type="checkbox" wire:model="selectedSizes" value="{{ $id }}" class="peer sr-only" />
                            <span class="inline-flex rounded-full border border-line px-3 py-1 text-xs text-ink-muted peer-checked:border-olive peer-checked:bg-olive-soft peer-checked:text-dark-olive">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-4">
            <x-admin.button type="button" wire:click="generate" variant="secondary">{{ __('Generate matrix') }}</x-admin.button>
        </div>
    </x-admin.card>

    @if (! empty($rows))
        {{-- Bulk fill --}}
        <x-admin.card :title="__('Bulk fill')" :description="__('Apply a value to every row below.')">
            <div class="flex flex-wrap items-end gap-3">
                <x-admin.field :label="__('Price (online)')">
                    <input type="number" step="0.01" min="0" wire:model="bulkPriceOnline" class="admin-input w-32" />
                </x-admin.field>
                <x-admin.field :label="__('Price (final)')">
                    <input type="number" step="0.01" min="0" wire:model="bulkPriceFinal" class="admin-input w-32" />
                </x-admin.field>
                <x-admin.field :label="__('Quantity')">
                    <input type="number" min="0" wire:model="bulkQuantity" class="admin-input w-28" />
                </x-admin.field>
                <x-admin.button type="button" wire:click="applyBulk" variant="secondary">{{ __('Apply to all') }}</x-admin.button>
            </div>
        </x-admin.card>

        {{-- Matrix --}}
        <form wire:submit="save" class="space-y-4">
            <div class="admin-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-line text-sm">
                        <thead class="bg-surface-2 text-xs tracking-wide text-ink-muted uppercase">
                            <tr>
                                <th class="admin-table-cell text-left font-medium">{{ __('Colour') }}</th>
                                <th class="admin-table-cell text-left font-medium">{{ __('Size') }}</th>
                                <th class="admin-table-cell text-left font-medium">{{ __('SKU') }}</th>
                                <th class="admin-table-cell text-left font-medium">{{ __('Barcode') }}</th>
                                <th class="admin-table-cell text-left font-medium">{{ __('Price (online)') }}</th>
                                <th class="admin-table-cell text-left font-medium">{{ __('Price (final)') }}</th>
                                <th class="admin-table-cell text-left font-medium">{{ __('Qty') }}</th>
                                <th class="admin-table-cell text-center font-medium">{{ __('Visible') }}</th>
                                <th class="admin-table-cell"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-line">
                            @foreach ($rows as $i => $row)
                                <tr wire:key="row-{{ $row['color_id'] }}-{{ $row['size_id'] }}" class="hover:bg-surface-2">
                                    <td class="admin-table-cell text-ink">{{ $colors[$row['color_id']] ?? $row['color_id'] }}</td>
                                    <td class="admin-table-cell text-ink">{{ $sizes[$row['size_id']] ?? $row['size_id'] }}</td>
                                    <td class="admin-table-cell"><input type="text" wire:model="rows.{{ $i }}.sku" class="admin-input w-28" /></td>
                                    <td class="admin-table-cell"><input type="text" wire:model="rows.{{ $i }}.barcode" class="admin-input w-40 font-mono text-xs" /></td>
                                    <td class="admin-table-cell"><input type="number" step="0.01" min="0" wire:model="rows.{{ $i }}.price_online" class="admin-input w-24" /></td>
                                    <td class="admin-table-cell"><input type="number" step="0.01" min="0" wire:model="rows.{{ $i }}.price_final" class="admin-input w-24" /></td>
                                    <td class="admin-table-cell"><input type="number" min="0" wire:model="rows.{{ $i }}.quantity" class="admin-input w-20" /></td>
                                    <td class="admin-table-cell text-center"><input type="checkbox" wire:model="rows.{{ $i }}.is_visible" class="size-4 accent-olive" /></td>
                                    <td class="admin-table-cell text-right">
                                        <button type="button" wire:click="removeRow({{ $i }})" class="admin-btn admin-btn--ghost text-danger hover:bg-danger/10">{{ __('Remove') }}</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @error('rows.*.sku') <p class="text-xs text-danger">{{ $message }}</p> @enderror

            <div class="flex items-center gap-3">
                <button type="submit" class="admin-btn admin-btn--primary" wire:loading.attr="disabled" wire:target="save">
                    <span wire:loading.remove wire:target="save">{{ __('Save variants') }}</span>
                    <span wire:loading wire:target="save">{{ __('Saving…') }}</span>
                </button>
                <span class="text-xs text-ink-muted">{{ count($rows) }} {{ __('variants') }}</span>
            </div>
        </form>
    @else
        <x-admin.card>
            <p class="py-6 text-center text-sm text-ink-muted">{{ __('No variants yet. Pick colours and sizes above, then generate the matrix.') }}</p>
        </x-admin.card>
    @endif
</div>
