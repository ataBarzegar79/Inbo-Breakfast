<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use mysql_xdevapi\Table;

//todo document model parameters *done: anyway needs checking

/**
 * @method static create(array $array)
 */
class Rate extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ratings';

    protected $fillable = [
        'rate',
        'description',
        'user_id',
        'breakfast_id'
    ];

    public function breakfast(): BelongsTo //fixme define return type for functions *done
    {
        return $this->belongsTo(Breakfast::class);
    }

    public function user(): BelongsTo //fixme define return type for functions *done
    {
        return $this->belongsTo(User::class);
    }

}
