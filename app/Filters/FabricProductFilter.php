<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class FabricProductFilter
{
    public function __construct(private ?array $fabric)
    {
    }

    public function __invoke(Builder $query, $next)
    {
        
        if (is_array($this->fabric) && (!array_key_exists(0, $this->fabric) && count($this->fabric))) {
            $query->whereIn('fabric_id', array_keys($this->fabric));
        }

        return $next($query);
    }
}
