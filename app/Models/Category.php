<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use SoftDeletes, HasFactory, HasTranslations, HasTranslatableSlug, Searchable;

    public array $translatable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_visible' => 'boolean',
    ];


    protected $fillable = [
        'parent_id',
        'is_visible',
        'name',
        'slug',
        'description',
        'image',
    ];

    protected $withCount = [
        'products',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function subcategories(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')
            ->orderBy('id', 'asc');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Determine if the model should be searchable.
     */
    public function shouldBeSearchable(): bool
    {
        return $this->is_visible;
    }

    /**
     * Get the name of the index associated with the model.
     */
    public function searchableAs(): string
    {
        return 'categories_index';
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'name' => (array) $this->name,
            'description' => (array) $this->description,
        ];
    }

    public function resolveRouteBindingQuery($query, $value, $field = null): Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Eloquent\Builder|\Illuminate\Contracts\Database\Eloquent\Builder
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
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
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
