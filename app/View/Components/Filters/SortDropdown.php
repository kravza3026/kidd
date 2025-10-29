<?php

namespace App\View\Components\Filters;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SortDropdown extends Component
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
            ? 'components.filtersMobile.sort-dropdown'
            : 'components.filters.sort-dropdown';

        return view($view);
    }

}
