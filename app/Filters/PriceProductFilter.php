<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class PriceProductFilter
{
    public function __construct(private ?array $price) {}

    public function __invoke(Builder $query, $next)
    {

        if (is_array($this->price)) {

            $query->when(array_key_exists('discounted', $this->price), fn ($query) => $query->where('has_discount', '=', true));

            if (isset($this->price['from']) && $this->price['from'] > 0 && isset($this->price['to']) && $this->price['to'] < 9999999) {
                if (! ($this->price['from'] > $this->price['to'])) {

                    $query->whereHas('variants', function ($query) {
                        $query->whereBetween('price_final', [(int) $this->price['from'] * 100, (int) $this->price['to'] * 100]);
                    });

                }
            } elseif (isset($this->price['from']) && $this->price['from'] > 0) {

                $query->whereHas('variants', function ($query) {
                    $query->where('price_final', '>=', (int) $this->price['from'] * 100);
                });

            } elseif (isset($this->price['to']) && $this->price['to'] < 999999999) {

                $query->whereHas('variants', function ($query) {
                    $query->where('price_final', '<=', (int) $this->price['to'] * 100);
                });

            }
        }

        return $next($query);
    }
}
