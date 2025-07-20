<?php

namespace App\View\Components\Filters;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class FamilyDropdown extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {

        $family_members = Cache::rememberForever('family_'.auth()->id(), function () {
            return auth()->user()->family;
        });

        return view('components.filters.family-dropdown',
            compact('family_members')
        );

    }
}
