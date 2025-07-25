<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements LocalizedUrlRoutable
{
    use Searchable, SoftDeletes, HasFactory, HasTranslations, HasTranslatableSlug;

    public array $translatable = [
        'name',
        'slug',
        'description',
    ];

    protected $fillable = [
        'category_id',
        'brand_id',
        'gender_id',
        'season_id',
        'fabric_id',

        'name',
        'slug',
        'image',
        'description',

        'barcode',

        'rating',
        'review_count',

        'is_visible',
        'is_new',
        'has_discount',
        'is_featured',
        'is_bestseller',
    ];

    protected $casts = [
        'name' => 'json',
        'slug' => 'json',
        'description' => 'json',

        'has_discount' => 'boolean',
        'is_visible' => 'boolean',
        'is_new' => 'boolean',
        'is_featured' => 'boolean',
        'is_bestseller' => 'boolean',
    ];

    protected $with = [
        'category',
        'brand',
        'gender',
        'season',
        'fabric',
        'variants',
        'variants.color',
        'variants.size',
//        'variants.images',
    ];

    protected $appends = [
        'url',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function fabric(): BelongsTo
    {
        return $this->belongsTo(Fabric::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function link(): string
    {
        return LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale() ?? 'ro', 'routes.catalog.{category}/{product}', [
            'category' => $this->category->slug,
            'product' => $this->slug,
        ]);
    }

    public function getUrlAttribute(): string
    {
        return LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale() ?? 'ro', 'routes.catalog.{category}/{product}', [
            'category' => $this->category->slug,
            'product' => $this->slug,
        ]);
    }

    /**
     * Resolve the route binding query for the model.
     *
     * @param  \Illuminate\Database\Eloquent\Builder|Builder  $query
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Builder|Builder|Model|Relation
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
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getLocalizedRouteKey($locale): string
    {
        return $this->getSlugOptions()->slugField.'->'.$locale;
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
        return 'products_index';
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'name' => (array) $this->name,
            'description' => (array) $this->description,


        ];
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'product_user', 'product_id', 'user_id');
    }

}
