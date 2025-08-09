<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;

class Vacancy extends Model
{
    use HasTranslations, HasTranslatableSlug, HasTags, HasFactory, SoftDeletes;

    protected array $translatable = [
        'title',
        'slug',
        'summary',
        'responsibilities',
        'requirements',
        'extra',
    ];

    protected $fillable = [
        'title',
        'slug',
        'remote',
        'summary',
        'responsibilities',
        'requirements',
        'extra',
        'notes',
    ];

    protected $casts = [
        'remote' => 'bool',
    ];

    /**
     * Company vacancy belongs to.
     *
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Location for which Vacancy is for.
     *
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::createWithLocales(array_keys(config('app.locales')))
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

}
