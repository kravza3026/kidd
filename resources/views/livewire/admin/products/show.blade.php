<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Products'), 'route' => 'admin.products.index'],
        ['label' => $product->getTranslation('name', app()->getLocale())],
    ]" />

    <x-admin.page-header :title="$product->getTranslation('name', app()->getLocale())" :subtitle="__('Product')">
        <x-slot:actions>
            @can('update', $product)
                <x-admin.button :href="route('admin.products.edit', $product)" wire:navigate>{{ __('Edit') }}</x-admin.button>
            @endcan
        </x-slot:actions>
    </x-admin.page-header>

    <div class="grid gap-4 lg:grid-cols-3">
        <x-admin.card :title="__('Classification')" class="lg:col-span-1">
            <dl class="grid grid-cols-2 gap-y-2.5 text-sm">
                <dt class="text-ink-muted">{{ __('Category') }}</dt>
                <dd class="text-ink">{{ $product->category?->getTranslation('name', app()->getLocale()) ?? '—' }}</dd>
                <dt class="text-ink-muted">{{ __('Brand') }}</dt>
                <dd class="text-ink">{{ $product->brand?->getTranslation('name', app()->getLocale()) ?? '—' }}</dd>
                <dt class="text-ink-muted">{{ __('Gender') }}</dt>
                <dd class="text-ink">{{ $product->gender?->getTranslation('name', app()->getLocale()) ?? '—' }}</dd>
                <dt class="text-ink-muted">{{ __('Season') }}</dt>
                <dd class="text-ink">{{ $product->season?->getTranslation('name', app()->getLocale()) ?? '—' }}</dd>
                <dt class="text-ink-muted">{{ __('Fabric') }}</dt>
                <dd class="text-ink">{{ $product->fabric?->getTranslation('name', app()->getLocale()) ?? '—' }}</dd>
                <dt class="text-ink-muted">{{ __('Barcode') }}</dt>
                <dd class="text-ink">{{ $product->barcode ?? '—' }}</dd>
            </dl>
            <div class="mt-3 flex flex-wrap gap-1 border-t border-line pt-3">
                <x-admin.status-badge :color="$product->is_visible ? 'green' : 'gray'" :label="$product->is_visible ? __('Visible') : __('Hidden')" />
                @if ($product->is_new)<x-admin.status-badge color="blue" :label="__('New')" />@endif
                @if ($product->is_featured)<x-admin.status-badge color="purple" :label="__('Featured')" />@endif
                @if ($product->has_discount)<x-admin.status-badge color="red" :label="__('Sale')" />@endif
                @if ($product->is_bestseller)<x-admin.status-badge color="yellow" :label="__('Best')" />@endif
            </div>
        </x-admin.card>

        <x-admin.card :title="__('Variants')" class="lg:col-span-2">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-line text-sm">
                    <thead class="text-xs text-ink-muted uppercase">
                        <tr>
                            <th class="admin-table-cell text-left font-medium">{{ __('SKU') }}</th>
                            <th class="admin-table-cell text-left font-medium">{{ __('Color') }}</th>
                            <th class="admin-table-cell text-left font-medium">{{ __('Size') }}</th>
                            <th class="admin-table-cell text-left font-medium">{{ __('Price') }}</th>
                            <th class="admin-table-cell text-left font-medium">{{ __('Stock') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @forelse ($product->variants as $variant)
                            <tr wire:key="var-{{ $variant->id }}">
                                <td class="admin-table-cell text-ink">{{ $variant->sku ?? '—' }}</td>
                                <td class="admin-table-cell text-ink-muted">{{ $variant->color?->getTranslation('name', app()->getLocale()) ?? '—' }}</td>
                                <td class="admin-table-cell text-ink-muted">{{ $variant->size?->getTranslation('name', app()->getLocale()) ?? '—' }}</td>
                                <td class="admin-table-cell text-ink">{{ $variant->price_online }}</td>
                                <td class="admin-table-cell text-ink-muted">{{ $variant->quantity }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="admin-table-cell py-8 text-center text-ink-muted">{{ __('No variants yet.') }}</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-admin.card>
    </div>
</div>
