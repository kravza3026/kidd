<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ColorProductFilter
{
    public function __construct(private ?array $color)
    {
    }

    public function __invoke(Builder $query, $next)
    {

        if (is_array($this->color) && (!array_key_exists(0, $this->color) && count($this->color))) {
            $query->whereHas('variants', function ($query) {
                $query->whereIn('color_id', array_keys($this->color));
            });
        }

        return $next($query);
    }
}
