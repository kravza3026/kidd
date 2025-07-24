<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Color extends Model
{
    use HasTranslations, HasTranslatableSlug;

    public array $translatable = [
        'name',
        'slug',
    ];

    protected $guarded = [];

    protected $casts = [
        'name' => 'json',
        'slug' => 'json',
    ];

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

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getLocalizedRouteKey($locale): string
    {
        return $this->getSlugOptions()->slugField . '->' . $locale;
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::createWithLocales(array_keys(config('app.locales')))
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
