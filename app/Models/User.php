<?php

namespace App\Models;

use App\Enums\AddressType;
use App\MustVerifyPhone;
use App\Traits\MustVerifyPhone as PhoneConfirmation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;

class User extends Authenticatable implements MustVerifyEmail, MustVerifyPhone, HasLocalePreference
{
    use SoftDeletes, PhoneConfirmation, HasApiTokens, HasFactory, HasRoles, HasPermissions, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id', //TODO change this to the company_id of the user
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',

        'newsletter',
        'new_order_to_email',
        'new_order_to_sms',
        'order_status_email',
        'order_status_sms',

        'email_marketing',
        'sms_marketing',

        'default_locale',
    ];

    protected $with = [
        'family', // TODO - Remove/replace when implementing family compatibility functionality/feature.
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
//    protected $with = ['addresses'];
    protected $withCount = [
        'favorites',
        'orders',
        'addresses',
    ];

    /**
     * The attributes that should be appended to model.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'name'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'phone' => E164PhoneNumberCast::class.':MD',
        'email_marketing' => 'boolean',
        'sms_marketing' => 'boolean',
        'phone_verified_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected array $dates = [
        'phone_verified_at',
        'email_verified_at',
    ];

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Get the user's preferred locale.
     */
    public function preferredLocale()
    {
        return $this->default_locale ?? config('app.locale');
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function name(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => ($attributes['first_name'].' '.$attributes['last_name']),
        )->shouldCache(); //withObjectCaching();
    }

    public function company(): belongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function family(): hasMany
    {
        return $this->hasMany(Family::class);
    }


    /**
     * Get all the user's favorite products.
     */
    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_user', 'user_id', 'product_id');
    }

    /**
     * Get all the user's orders.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get all the user's addresses.
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Get all the user's shipping addresses.
     */
    public function shippingAddresses(): MorphMany
    {
        return $this->addresses()->type(AddressType::Shipping);
    }

    /**
     * Get all the user's billing addresses.
     */
    public function billingAddresses(): MorphMany
    {
        return $this->addresses()->type(AddressType::Billing);
    }

}
