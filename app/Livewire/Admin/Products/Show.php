<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
class Show extends Component
{
    public Product $product;

    public function mount(Product $product): void
    {
        $this->authorize('view', $product);
        $this->product = $product->load(['category', 'brand', 'gender', 'season', 'fabric', 'variants.color', 'variants.size']);
    }

    public function render(): View
    {
        return view('livewire.admin.products.show');
    }
}
