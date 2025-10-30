<?php

namespace App\View\Components\Filters;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PriceDropdown extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $variant = 'desktop') {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $view = $this->variant === 'mobile'
            ? 'components.filtersMobile.price-dropdown'
            : 'components.filters.price-dropdown';

        return view($view);
    }
}
