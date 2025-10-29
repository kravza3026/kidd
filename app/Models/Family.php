<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

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
        'compatible_sizes_ids',
        'age_diff',
    ];

    protected $with = [
        'gender',
    ];

    protected static function booted(): void
    {
        static::created(fn ($member) => Cache::forget($member->compatibilityCacheKey()));
        static::updated(fn ($member) => Cache::forget($member->compatibilityCacheKey()));
        static::deleted(fn ($member) => Cache::forget($member->compatibilityCacheKey()));
    }

    /**
     * Get the cache key for the family member.
     */
    protected function compatibilityCacheKey(): string
    {
        return "family_member:{$this->id}:compatible_sizes";
    }

    public function getWeightAttribute(): float|int
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

    public function getCompatibleSizesIdsAttribute()
    {
        return Cache::flexible($this->compatibilityCacheKey(), [360, 1440], function () {
            return $this->compatibleSizes()->pluck('id')->toArray();
        }, alwaysDefer: true);
    }

    public function compatibleSizes()
    {
        return Size::forMember($this)->get();
    }
}
