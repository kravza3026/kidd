<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Brand extends Model
{
    use SoftDeletes, HasTranslations, HasTranslatableSlug;

    public array $translatable = [
        'name',
        'slug',
        'description',
    ];

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
    ];

    protected $casts = [
        'name' => 'json',
        'slug' => 'json',
        'description' => 'json',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

}
