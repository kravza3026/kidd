<?php

namespace App\View\Components\Filters;

use App\Models\Color;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class ColorsDropdown extends Component
{

    public function render(): View|Closure|string
    {

        $colors = Cache::rememberForever('colors', function () {
            return Color::all();
        });

        return view('components.filters.colors-dropdown',
            compact('colors')
        );

    }
    
}
