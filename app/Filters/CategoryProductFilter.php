<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class CategoryProductFilter
{
    public function __construct(private ?int $category)
    {
    }

    public function __invoke(mixed $query, $next)
    {

        $query->when($this->category, function ($query) {
            $query->where('category_id', $this->category);
        });

        return $next($query);
    }
}
