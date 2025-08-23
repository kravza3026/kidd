<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Location extends Model
{
    use HasTranslations, SoftDeletes;

    /**
     * Location type Warehouse
     */
    const int TYPE_WAREHOUSE = 1;

    /**
     * Location type Store
     */
    const int TYPE_STORE = 2;

    protected array $translatable = [
        'name',
        'open_hours',
    ];

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'geo_position' => 'array',
    ];

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
