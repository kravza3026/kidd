<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Season extends Model
{
    use HasTranslations;

    public array $translatable = [
        'name',
    ];

    protected $guarded = [];

    protected $withCount = [
        'products',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
