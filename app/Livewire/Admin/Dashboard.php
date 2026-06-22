<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render(): View
    {
        $threshold = (int) config('admin.low_stock_threshold', 5);

        return view('livewire.admin.dashboard', [
            'stats' => [
                'products' => Product::count(),
                'categories' => Category::count(),
                'orders' => Order::count(),
                'customers' => Customer::count(),
            ],
            'lowStock' => ProductVariant::where('quantity', '<=', $threshold)
                ->with('product')
                ->orderBy('quantity')
                ->limit(8)
                ->get(),
            'recentOrders' => Order::with('customer')
                ->latest()
                ->limit(8)
                ->get(),
        ]);
    }
}
