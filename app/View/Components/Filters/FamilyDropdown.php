<?php

namespace App\View\Components\Filters;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class FamilyDropdown extends Component
{
    public function __construct(public string $variant = 'desktop') {}

    public function render(): View
    {
        $family_members = Cache::rememberForever('family_' . auth()->id(), function () {
            return auth()->user()->family;
        });

        $view = $this->variant === 'mobile'
            ? 'components.filtersMobile.family-dropdown'
            : 'components.filters.family-dropdown';

        return view($view, compact('family_members'));
    }
}
