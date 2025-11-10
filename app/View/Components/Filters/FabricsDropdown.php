<?php

namespace App\View\Components\Filters;

use App\Models\Fabric;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class FabricsDropdown extends Component
{
    public function __construct(public string $variant = 'desktop') {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|string
    {
        $fabrics = Cache::rememberForever('fabrics_filter', function () {
            return Fabric::all();
        });

        $view = $this->variant === 'mobile'
            ? 'components.filtersMobile.fabrics-dropdown'
            : 'components.filters.fabrics-dropdown';

        return view($view, compact('fabrics'));
    }
}
