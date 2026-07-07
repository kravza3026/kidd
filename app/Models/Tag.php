<?php

namespace App\Models;

use Spatie\Sluggable\SlugOptions;

class Tag extends \Spatie\Tags\Tag
{
    public static function getTagClassName(): string
    {
        return Tag::class;
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

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
