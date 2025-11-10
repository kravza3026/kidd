<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class GenderProductFilter
{
    public function __construct(private ?array $gender)
    {
        $this->gender = array_filter($gender, fn ($filter) => is_int($filter), ARRAY_FILTER_USE_KEY);
    }

    public function __invoke(Builder $query, $next)
    {

        if (is_array($this->gender) && (! array_key_exists(0, $this->gender) && count($this->gender))) {
            $query->whereIn('gender_id', array_keys($this->gender));
        }

        return $next($query);
    }
}
