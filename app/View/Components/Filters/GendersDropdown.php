<?php

namespace App\View\Components\Filters;

use App\Models\Gender;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class GendersDropdown extends Component
{

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View|Closure|string
    {

        $genders = Cache::rememberForever('genders', function () {
            return Gender::all();
        });

        return view('components.filters.genders-dropdown',
            compact('genders')
        );

    }
    
}
