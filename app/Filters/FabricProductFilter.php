<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class FabricProductFilter
{
    public function __construct(private ?array $fabric)
    {
        $this->fabric = $fabric ? array_filter($fabric, fn ($filter) => is_int($filter), ARRAY_FILTER_USE_KEY) : [];
    }

    public function __invoke(Builder $query, $next)
    {

        if (is_array($this->fabric) && (! array_key_exists(0, $this->fabric) && count($this->fabric))) {
            $query->whereIn('fabric_id', array_keys($this->fabric));
        }

        return $next($query);
    }
}
