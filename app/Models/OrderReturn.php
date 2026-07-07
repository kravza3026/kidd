<?php

namespace App\Models;

use App\Enums\ReturnReason;
use App\Enums\ReturnStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * A customer-submitted request to return items from a delivered order. Staff review and
 * progress it through the admin "Order returns" inbox.
 */
class OrderReturn extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'order_id',
        'customer_id',
        'reason',
        'status',
        'item_ids',
        'comment',
    ];

    protected $casts = [
        'reason' => ReturnReason::class,
        'status' => ReturnStatus::class,
        'item_ids' => 'array',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * The order items the customer selected for return.
     *
     * @return Collection<int, OrderItem>
     */
    public function selectedItems(): Collection
    {
        return $this->order->items->whereIn('id', $this->item_ids ?? [])->values();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }
}
