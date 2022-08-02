<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $array)
 * @property mixed $id
 * @property mixed $rate
 * @property mixed $description
 * @method static Builder|Rate findByUser(int $userId)
 * @method static Builder|Rate findByBreakfast(int $breakfastId)
 */
class Rate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ratings'; // fixme data base names must be according to psr principles

    protected $fillable = [
        'rate',
        'description',
        'user_id',
        'breakfast_id'
    ];

    public function breakfast(): BelongsTo
    {
        return $this->belongsTo(Breakfast::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFindByUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public function scopeFindByBreakfast(Builder $query, int $breakfastId): Builder
    {
        return $query->where('breakfast_id', $breakfastId);
    }
}
