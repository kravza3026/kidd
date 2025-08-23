<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'tracking_id',
        'payment_id',
        'order_number',
        'total_amount',
        'status',
        'shipping_address',
        'billing_address',
        'cart_snapshot',
        'notes',
        'placed_at',
        'processed_at',
        'delivered_at',
    ];

    protected array $dates = ['placed_at', 'processed_at', 'delivered_at'];

    protected $hidden = [
        'customer_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $with = [
        'customer',
        'items',
        'user',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user(): HasOneThrough|User
    {
        return $this->hasOneThrough(User::class, Customer::class, 'id', 'id', 'customer_id', 'user_id');
    }

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'shipping_address' => 'array',
            'billing_address' => 'array',
            'cart_snapshot' => 'array',
            'placed_at' => 'datetime:Y-m-d',
            'processed_at' => 'datetime:Y-m-d',
            'delivered_at' => 'datetime:Y-m-d',
        ];
    }
}
