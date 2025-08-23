<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia, LocalizedUrlRoutable
{
    use HasFactory, HasTranslatableSlug, HasTranslations, InteractsWithMedia, Searchable, SoftDeletes;

    /**
     * The attributes that are translatable.
     */
    public array $translatable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
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

    /**
     * The Relations that should be queried in the model.
     *
     * @var array
     */
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

    /**
     * The attributes that should be appended to the model.
     *
     * @var array
     */
    protected $appends = [
        'url',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the variants associated with the product.
     */
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * Get the brand that the product is.
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the product gender relation.
     */
    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * Get the season that the product is.
     */
    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    /**
     * Get the fabric that the product is made of.
     */
    public function fabric(): BelongsTo
    {
        return $this->belongsTo(Fabric::class);
    }

    /**
     * Get the URL for the product.
     */
    public function getUrlAttribute(): string
    {
        $url = route('products.show', [
            'category' => $this->category->slug,
            'product' => $this->slug,
        ]);

        return LaravelLocalization::localizeURL($url);

        //        return LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale() ?? 'ro', 'routes.catalog.{category}/{product}', [
        //            'category' => $this->category->slug,
        //            'product' => $this->slug,
        //        ]);
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
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the localized route key for the model.
     *
     * @param  string  $locale
     */
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

    /**
     * Get the array that should be indexed for the model.
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'name' => (array) $this->name,
            //            'description' => (array) $this->description,
        ];
    }

    /**
     * The users that 'Favorited' to the product.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'product_user', 'product_id', 'user_id');
    }

    /**
     * Register the media collections for the model.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnail')
            ->useFallbackUrl('/images/placeholder.png', 'preview')
            ->useFallbackPath(public_path('images/placeholder.png'));

        $this->addMediaCollection('gallery')
            ->useFallbackUrl('/images/placeholder.png', 'gallery')
            ->useFallbackPath(public_path('images/placeholder.png'));
    }

    /**
     * Register the media conversions for the model.
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->performOnCollections('thumbnail')
            ->fit(Fit::Contain, 330, 360);

        $this->addMediaConversion('gallery')
            ->performOnCollections('gallery')
            ->fit(Fit::Contain, 630, 640)
            ->quality(90)
            ->withResponsiveImages();
    }
}
