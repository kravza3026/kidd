<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Color extends Model
{
    use HasTranslations;

    public array $translatable = [
        'name',
    ];

    protected $guarded = [];

    protected $withCount = [
        'products'
    ];

    public function products()
    {
        return $this->hasManyThrough(Product::class, ProductVariant::class, 'color_id', 'id', 'id', 'product_id');
    }

//    public function products()
//    {
//        return $this->belongsToMany(Product::class);
//    }
}
