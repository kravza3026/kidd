<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Gender extends Model
{
    use HasTranslations;

    public const int UNISEX = 1;
    public const int BOY = 2;
    public const int GIRL = 3;

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

    protected function bgColor(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $value ?? 'bg-[#eee]';
            });
//            set: fn ($value) => [
//                'first_name' => explode(' ', $value)[0],
//                'last_name' => explode(' ', $value)[1] ?? '',
//            ],

    }

}
