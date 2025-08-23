<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Family extends Model
{
    use SoftDeletes;

    protected array $dates = [
        'birth_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string, string>
     */
    protected $fillable = [
        'name',
        'birth_date',
        'gender_id',
        'height',
        'weight',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
    ];

    protected $appends = [
        'age_diff',
    ];

    protected $with = [
        'gender',
    ];

    public function getWeightAttribute()
    {
        return $this->attributes['weight'] / 1000; // Convert grams to kilograms
    }

    public function getAgeDiffAttribute(): Carbon|string
    {
        return $this->birth_date
            ? $this->birth_date->diffForHumans([
                'parts' => 2,
                'short' => true,
                'options' => CarbonInterface::SEQUENTIAL_PARTS_ONLY | CarbonInterface::TWO_DAY_WORDS,
                'syntax' => CarbonInterface::DIFF_ABSOLUTE,
            ])
            : $this->birth_date->format('d.m.Y');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }
}
