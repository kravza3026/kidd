<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Products'), 'route' => 'admin.products.index'],
        ['label' => $product->getTranslation('name', app()->getLocale()), 'route' => 'admin.products.show', 'params' => $product->id],
        ['label' => __('Print labels')],
    ]" />

    <x-admin.page-header :title="__('Print labels')" :subtitle="$product->getTranslation('name', app()->getLocale())">
        <x-slot:actions>
            <button type="button" onclick="window.print()" class="admin-btn admin-btn--primary print:hidden">{{ __('Print') }}</button>
            <x-admin.button :href="route('admin.products.show', $product->id)" wire:navigate variant="secondary" class="print:hidden">{{ __('Back') }}</x-admin.button>
        </x-slot:actions>
    </x-admin.page-header>

    @if ($labels->isNotEmpty())
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4 print:grid-cols-4">
            @foreach ($labels as $label)
                <div class="flex flex-col items-center gap-1 rounded-lg border border-line bg-white p-3 text-center" wire:key="label-{{ $label['sku'] }}">
                    <p class="line-clamp-1 text-xs font-semibold text-charcoal">{{ $label['name'] }}</p>
                    <p class="text-[10px] text-gray-500">{{ $label['variant'] }}</p>
                    <div class="my-1 w-full">{!! $label['svg'] !!}</div>
                    <p class="font-mono text-[10px] text-gray-700">{{ $label['barcode'] }}</p>
                    <p class="text-[10px] font-semibold text-charcoal">{{ $label['sku'] }}</p>
                </div>
            @endforeach
        </div>
    @else
        <x-admin.card>
            <p class="py-6 text-center text-sm text-ink-muted">{{ __('No printable barcodes. Generate variant barcodes first.') }}</p>
        </x-admin.card>
    @endif
</div>
