<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;


//todo document model parameters *done: anyway needs checking

/**
 * @method static find(int $breakfast_id)
 * @method static create(array $array)
 * @property mixed $rates
 */
class Breakfast extends Model
{
    use HasFactory, SoftDeletes;

    //todo table name is redundant *done: deleted protected $table = 'breakfasts';
    protected $fillable = [
        'name',
        'description',
        'created_at',
        'user_id'
    ];

    //fixme define return type for functions *done
    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }

    //fixme define return type for functions *done
    //fixme: pay attention to indentations *done
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTrashed();
    }

    //todo move business logic to service layer
    //fixme define return type for functions *done
    public function avareageRate(): float
    {
        $rates = $this->rates->avg('rate');
        return round($rates, 2);
    }

    //fixme define return type for functions *done
    //todo remove unused functions
    public function userRate(): ?array
    {
        // $user = Auth::user(); // todo: delete this
        $rates = $this->rates;
        foreach ($rates as $rate) {
            if ($rate->user_id == Auth::id()) {  // todo I changed $user_id to Auth::id() because of some warning, need to be checked if it's working
                return ['rate' => $rate->rate, 'description' => $rate->description];
            }
        }
        return null;
    }

}
