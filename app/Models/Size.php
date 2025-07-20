<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Size extends Model
{
    use HasTranslations;

    public array $translatable = [
        'name',
    ];

    protected $guarded = [];

    protected $with = [
//        'products', // memory leak!
    ];

    protected $withCount = [
        'products'
    ];

    public function products()
    {
        return $this->hasManyThrough(Product::class, ProductVariant::class, 'size_id', 'id', 'id', 'product_id');
    }

}
