<?php

namespace App\View\Components\Filters;

use App\Models\Gender;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class GendersDropdown extends Component
{
    public function __construct(public string $variant = 'desktop') {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $genders = Cache::rememberForever('genders', function () {
            return Gender::all();
        });

        $view = $this->variant === 'mobile'
            ? 'components.filtersMobile.genders-dropdown'
            : 'components.filters.genders-dropdown';

        return view($view, compact('genders'));
    }
}
