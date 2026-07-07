<?php

namespace App\Models;

use Database\Factories\AttributeGroupFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * A reorderable, translatable group within a taxonomy (e.g. Sizes → Clothing / Shoes /
 * Diapers). `attribute` is the admin resource key the group belongs to (brand, color,
 * size, …); taxonomy rows reference a group via attribute_group_id.
 */
class AttributeGroup extends Model
{
    /** @use HasFactory<AttributeGroupFactory> */
    use HasFactory, HasTranslations;

    public array $translatable = ['name'];

    protected $fillable = ['attribute', 'name', 'sort_order'];

    protected $casts = [
        'name' => 'json',
        'sort_order' => 'integer',
    ];

    /**
     * @param  Builder<AttributeGroup>  $query
     * @return Builder<AttributeGroup>
     */
    public function scopeForAttribute(Builder $query, string $attribute): Builder
    {
        return $query->where('attribute', $attribute)->orderBy('sort_order');
    }
}
