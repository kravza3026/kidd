<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class SizeProductFilter
{
    public function __construct(private ?array $size)
    {
        $this->size = array_filter($size, fn ($filter) => is_int($filter), ARRAY_FILTER_USE_KEY);
    }

    public function __invoke(Builder $query, $next)
    {

        if (is_array($this->size) && (! array_key_exists(0, $this->size) && count($this->size))) {
            $query->whereHas('variants', function ($query) {
                $query->whereIn('size_id', array_keys($this->size));
            });
        }

        return $next($query);
    }
}
