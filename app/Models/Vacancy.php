<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

class Vacancy extends Model
{
    use HasFactory, HasTags, HasTranslatableSlug, HasTranslations, SoftDeletes;

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

    protected $appends = [
        'url',
        'application_url',
    ];

    /**
     * Company vacancy belongs to.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Relation for applicants for this vacancy.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(VacancyApplication::class);
    }

    /**
     * Location for which Vacancy is for.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function getUrlAttribute(): string
    {
        return route('vacancy.show', [
            'vacancy' => $this,
        ]);
    }

    public function getApplicationUrlAttribute(): string
    {
        return route('vacancy.application.create', [
            'vacancy' => $this,
        ]);
    }

    /**
     * Resolve the route binding query for the model.
     *
     * @param  \Illuminate\Database\Eloquent\Builder|Builder  $query
     * @param  mixed  $value
     * @param  string|null  $field
     */
    public function resolveRouteBindingQuery($query, $value, $field = null): Model|Relation|\Illuminate\Database\Eloquent\Builder|Builder
    {
        $field = $field ?? $this->getRouteKeyName();

        if ($field !== $this->getSlugOptions()->slugField) {
            return parent::resolveRouteBindingQuery($query, $value, $field);
        }

        return $query->where(function ($query) use ($field, $value) {
            foreach (array_keys(config('app.locales')) as $locale) {
                $query->orWhere("{$field}->{$locale}", $value);
            }
        });
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::createWithLocales(array_keys(config('app.locales')))
            ->generateSlugsFrom('title')
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
