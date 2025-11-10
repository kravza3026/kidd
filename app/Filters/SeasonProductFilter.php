<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class SeasonProductFilter
{
    public function __construct(private ?array $season)
    {
        $this->season = array_filter($this->season, fn ($filter) => is_int($filter), ARRAY_FILTER_USE_KEY);
    }

    public function __invoke(Builder $query, $next)
    {

        if (is_array($this->season) && (! array_key_exists(0, $this->season) && count($this->season))) {
            $query->whereIn('season_id', array_keys($this->season));
        }

        return $next($query);
    }
}
