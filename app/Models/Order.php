<?php

namespace App\Models;

use App\Enums\AddressType;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\ShippingMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Order extends Model
{
    use HasFactory;

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
        'shipping_method',
        'payment_method',
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
        'shippingAddresses',
        'billingAddresses',
    ];

    protected $casts = [
        'shipping_method' => ShippingMethod::class,
        'payment_method' => PaymentMethod::class,
        'status' => OrderStatus::class,
        'shipping_address' => 'array',
        'billing_address' => 'array',
        'cart_snapshot' => 'array',

        'placed_at' => 'datetime',
        'processed_at' => 'datetime',
        'delivered_at' => 'datetime',
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
     * Get all the user's shipping addresses.
     */
    public function shippingAddresses(): MorphMany
    {
        return $this->addresses()->type(AddressType::Shipping);
    }

    /**
     * Get all the user's addresses.
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Get all the user's billing addresses.
     */
    public function billingAddresses(): MorphMany
    {
        return $this->addresses()->type(AddressType::Billing);
    }
}
