<?php

namespace App\View\Components\Filters;

use App\Models\Fabric;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class FabricsDropdown extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        
        $fabrics = Cache::rememberForever('fabrics', function () {
            return Fabric::all();
        });

        return view('components.filters.fabrics-dropdown',
            compact('fabrics')
        );

    }
}
