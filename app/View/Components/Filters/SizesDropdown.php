<?php

namespace App\View\Components\Filters;

use App\Models\Size;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class SizesDropdown extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {

        $sizes = Cache::rememberForever('sizes', function () {
            return Size::withCount(['products as products_count' => function ($q) {
                $q->select(DB::raw('COUNT(DISTINCT kidd_product_variants.product_id)'));
            }])->get();
        });

        return view('components.filters.sizes-dropdown',
            compact('sizes')
        );

    }
}
