<?php

namespace App\Models;

use App\Enums\AddressType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'label',
        'is_default',
        'contact_first_name',
        'contact_last_name',
        'contact_phone',
        'contact_email',
        'company_name',
        'company_code',
        'vat_code',
        'address_type',
        'street_name',
        'building',
        'entrance',
        'floor',
        'apartment',
        'intercom',
        'city',
        'region',
        'country',
        'postal_code',
        'notes',
        'price',
    ];

    protected $with = [
        'region',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'address_type' => AddressType::class,
        'is_default' => 'boolean',
    ];

    /**
     * Scope a query to only include addresses of a given type.
     */
    public function scopeType(Builder $query, AddressType $type): void
    {
        $query->where('address_type', $type);
    }

    /**
     * Get the parent addressable model (user or company or order).
     */
    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
