<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ProductFilter
{
    /**
     * Apply filters to the query based on the request input.
     *
     * @param  Builder  $query
     * @param  $filters
     * @return Builder
     */
    public function scopeFilter(Builder $query, $filters): Builder
    {

        foreach ($filters ?? [] as $filter => $value) {
            $method = 'filter'.ucfirst($filter);

            if (method_exists($this, $method) && $value !== null) {
                $this->{$method}($query, $value);
            }
        }

        return $query;
    }

    /**
     * Filter by category.
     *
     * @param  Builder  $query
     * @param  string  $category
     */
    public function filterCategory(Builder $query, string $category)
    {
        $query->whereHas('category', function ($query) use ($category) {
            $query->whereJsonContains('slug->ro', $category);
            $query->orWhereJsonContains('slug->ru', $category);
            $query->orWhereJsonContains('slug->en', $category);
        });
    }

    /**
     * Filter by brand.
     *
     * @param  Builder  $query
     * @param  int  $brand
     */
    public function filterBrand(Builder $query, int $brand)
    {
        $query->where('brand_id', $brand);
    }

    /**
     * Filter by gender.
     *
     * @param  Builder  $query
     * @param  int  $gender
     */
    public function filterGender(Builder $query, int $gender)
    {
        $query->where('gender_id', $gender);
    }

    /**
     * Filter by season.
     *
     * @param  Builder  $query
     * @param  int  $season
     */
    public function filterSeason(Builder $query, int $season)
    {
        $query->where('season_id', $season);
    }

    /**
     * Filter by fabric.
     *
     * @param  Builder  $query
     * @param  array  $fabric
     */
    public function filterFabric(Builder $query, $fabric)
    {
        if (!array_key_exists(0, $fabric) && count($fabric)) {
            $query->whereIn('fabric_id', array_keys($fabric));
        }
    }

    /**
     * Filter by color.
     *
     * @param  Builder  $query
     * @param  int  $color
     */
    public function filterColor(Builder $query, int $color)
    {
        $query->whereHas('variants', function ($query) use ($color) {
            $query->where('color_id', $color);
        });
    }

    /**
     * Filter by size.
     *
     * @param  Builder  $query
     * @param  int  $size
     */
    public function filterSize(Builder $query, $size)
    {
        if (!array_key_exists(0, $size) && count($size)) {
            $query->whereHas('variants', function ($query) use ($size) {
                $query->whereIn('size_id', array_keys($size));
            });
        }

    }

    /**
     * Filter by price and discount.
     *
     * @param  Builder  $query
     * @param  array  $price
     */
    public function filterPrice(Builder $query, array $price)
    {

        if (isset($price['discounted']) && $price['discounted']) {
            $query->where(function ($query) {
                $query->whereHasDiscount(true);
            });
        }

        $query->whereHas('variants', function ($query) use ($price) {

            $query->where(function ($query) use ($price) {
                $query->where('price_online', '>=', $price['from'] ?? 0);
                $query->orWhere('price_final', '>=', $price['from'] ?? 0);
            });

            $query->where(function ($query) use ($price) {
                $query->where('price_online', '<=', $price['to'] ?? 999999);
                $query->orWhere('price_final', '<=', $price['to'] ?? 999999);
            });

        });

    }


}
