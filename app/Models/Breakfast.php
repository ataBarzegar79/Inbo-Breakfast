<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static find(int $breakfast_id)
 * @method static create(array $array)
 * @method static paginate(int $int)
 * @method static ordering()
 * @property mixed $rates
 * @property mixed $users
 * @property mixed $created_at
 * @property mixed $description
 * @property mixed $name
 * @property mixed $id
 */
class Breakfast extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'breakfasts'; // fixme data base names must be according to psr principles

    protected $fillable = [
        'name',
        'description',
        'created_at',
        'user_id'
    ];

    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTrashed();
    }

}
