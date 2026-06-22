<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',

        'is_visible',

        'sku',
        'barcode',
        'quantity',

        'price_vendor',
        'price_wholesale',
        'price_online',
        'price_store',

        'price_final',
        'discount_amount',
        'discount_display',
        'price_shipping',

        'shipping_sizes',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'quantity' => 'integer',
        'shipping_sizes' => 'array',
        'price_vendor' => MoneyCast::class.':MDL',
        'price_wholesale' => MoneyCast::class.':MDL',
        'price_online' => MoneyCast::class.':MDL',
        'price_store' => MoneyCast::class.':MDL',
        'price_final' => MoneyCast::class.':MDL',
        'price_shipping' => MoneyCast::class.':MDL',
    ];

    protected $with = [
        'color',
        'size',
    ];

    protected $touches = [
        'product',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc');
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc');
    }

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }
}
