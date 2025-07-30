<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Location extends Model
{

    use HasTranslations, SoftDeletes;

    protected array $translatable = [
        'name',
        'open_hours',
    ];

    protected $guarded = [];

    protected $hidden = [
        'address_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'geo_position' => 'array',
    ];


    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

}
