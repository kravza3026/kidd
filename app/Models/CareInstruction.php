<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class CareInstruction extends Model
{
    use HasTranslations;

    /**
     * The attributes that are translatable.
     */
    public array $translatable = [
        'title',
        'description',
    ];

    protected $fillable = [
        'sort_order',
        'icon',
        'title',
        'description',
    ];

    protected $guarded = [];

    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
