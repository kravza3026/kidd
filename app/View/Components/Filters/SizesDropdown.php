<?php

namespace App\View\Components\Filters;

use App\Models\Size;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class SizesDropdown extends Component
{

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {

        $sizes = Cache::rememberForever('sizes', function () {
            return Size::all();
        });

        return view('components.filters.sizes-dropdown',
            compact('sizes')
        );

    }

}
