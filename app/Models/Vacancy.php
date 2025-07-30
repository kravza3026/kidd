<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Vacancy extends Model
{
    use hasTranslations, SoftDeletes;

    protected array $translatable = [
        'title',
        'summary',
        'responsibilities',
        'requirements',
        'extra',
    ];

    protected $guarded = [];

    protected $casts = [
        'remote' => 'bool',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
