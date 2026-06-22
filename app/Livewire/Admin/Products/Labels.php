<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Support\Barcode;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

/**
 * Print-friendly sheet of 1D barcode labels for a product's variants — one label per
 * variant with its name, colour/size, SKU and a rendered EAN-13 barcode.
 */
#[Layout('layouts.admin.admin')]
#[Title('Print labels')]
class Labels extends Component
{
    public Product $product;

    public function mount(Product $product): void
    {
        $this->authorize('update', $product);
        $this->product = $product;
    }

    public function render(): View
    {
        $locale = app()->getLocale();

        $labels = $this->product->variants()
            ->with(['color', 'size'])
            ->whereNotNull('barcode')
            ->get()
            ->map(fn ($variant) => [
                'name' => $this->product->getTranslation('name', $locale),
                'variant' => trim(($variant->color?->getTranslation('name', $locale) ?? '').' · '.($variant->size?->getTranslation('name', $locale) ?? ''), ' ·'),
                'sku' => $variant->sku,
                'barcode' => $variant->barcode,
                'svg' => Barcode::svg($variant->barcode),
            ])
            ->filter(fn ($label) => $label['svg'] !== null)
            ->values();

        return view('livewire.admin.products.labels', [
            'labels' => $labels,
        ]);
    }
}
