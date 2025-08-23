<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactInquire extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'message',
    ];

    /**
     * User who made the contact inquiry if it was authenticated.
     **/
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
