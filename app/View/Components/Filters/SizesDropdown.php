<?php

namespace App\View\Components\Filters;

use App\Models\Size;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class SizesDropdown extends Component
{
    public function __construct(public string $variant = 'desktop') {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $sizes = Cache::rememberForever('sizes_filter', function () {
            return Size::withCount(['products as products_count' => function ($q) {
                $q->select(DB::raw('COUNT(DISTINCT kidd_product_variants.product_id)'));
            }])->get();
        });

        $view = $this->variant === 'mobile'
            ? 'components.filtersMobile.sizes-dropdown'
            : 'components.filters.sizes-dropdown';

        return view($view, compact('sizes'));
    }
}
