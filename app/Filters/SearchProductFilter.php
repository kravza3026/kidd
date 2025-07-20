<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class SearchProductFilter
{


    public function __construct(public ?string $search)
    {
    }

    public function __invoke(Builder $query, $next)
    {

        $query->when($this->search, function ($query) {
            $query->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('name->ro', 'like', '%'.$this->search.'%');
                    $query->orWhere('name->ru', 'like', '%'.$this->search.'%');
                    $query->orWhere('name->en', 'like', '%'.$this->search.'%');
                })->orWhere(function ($query) {
                    $query->where('description->ro', 'like', '%'.$this->search.'%');
                    $query->orWhere('description->ru', 'like', '%'.$this->search.'%');
                    $query->orWhere('description->en', 'like', '%'.$this->search.'%');
                });
            });
        });

        return $next($query);
    }
}
