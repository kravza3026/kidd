<?php

namespace App\View\Components\Filters;

use App\Models\Season;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class SeasonsDropdown extends Component
{

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View|Closure|string
    {

        $seasons = Cache::rememberForever('seasons', function () {
            return Season::all();
        });

        return view('components.filters.seasons-dropdown',
            compact('seasons')
        );

    }

}
