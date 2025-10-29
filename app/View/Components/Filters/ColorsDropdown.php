<?php

namespace App\View\Components\Filters;

use App\Models\Color;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class ColorsDropdown extends Component
{
    public function __construct(public string $variant = 'desktop') {}

    public function render(): View|Closure|string
    {
        $colors = Cache::rememberForever('colors', function () {
            return Color::withCount(['products as products_count' => function ($q) {
                $q->select(DB::raw('COUNT(DISTINCT kidd_product_variants.product_id)'));
            }])->get();
        });

        $view = $this->variant === 'mobile'
            ? 'components.filtersMobile.colors-dropdown'
            : 'components.filters.colors-dropdown';

        return view($view, compact('colors'));
    }
}
