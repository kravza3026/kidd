<?php

namespace App\Models;

use App\Enums\AddressType;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\ShippingMethod;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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
        //        'order_number',
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
        'user',
        'items',
        'shipping',
        'billing',
    ];

    protected $casts = [
        'shipping_method' => ShippingMethod::class,
        'payment_method' => PaymentMethod::class,
        'status' => OrderStatus::class,
        'cart_snapshot' => 'json',

        'placed_at' => 'datetime',
        'processed_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    /**
     * Get a customer for the order.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get all the products for the order.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the user for the order if it was authorised when order was placed.
     */
    public function user(): HasOneThrough|User
    {
        return $this->hasOneThrough(User::class, Customer::class, 'id', 'id', 'customer_id', 'user_id');
    }

    /**
     * Get the shipping addresses for the order.
     */
    public function shipping(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable')->where('address_type', '=', AddressType::Shipping);
    }

    /**
     * Get the billing address for the order.
     */
    public function billing(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable')->where('address_type', '=', AddressType::Billing);
    }

    /**
     * Get all the order's addresses.
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    protected function orderNumber(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? sprintf('ORD-%06d', $value) : strtoupper(uniqid('ORD-', false)),
            //            set: fn ($value) => (int) str_replace(['#ORD-', 'ORD-'], '', $value),
        );
    }
}
