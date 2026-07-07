<?php

namespace App\Models;

use App\Models\Concerns\BelongsToAttributeGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fabric extends Model
{
    use BelongsToAttributeGroup, HasFactory, HasTranslations;

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
