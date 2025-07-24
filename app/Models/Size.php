<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Size extends Model
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
