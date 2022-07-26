<?php

namespace App\Models;

use Carbon\Carbon;
use DivisionByZeroError;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use JetBrains\PhpStorm\ArrayShape;
use Laravel\Sanctum\HasApiTokens;

//todo document model parameters *done: anyway needs checking

/**
 * @property mixed $is_admin
 * @property mixed $id
 * @property mixed $breakfasts
 * @property mixed $avatar
 * @property mixed $created_at
 * @method static find(int $id)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'is_admin'
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
        'email_verified_at' => 'datetime',
    ];

    public function breakfasts(): BelongsToMany
    {
        //fixme define return type for functions *done
        return $this->belongsToMany(Breakfast::class)->withTrashed();
    }

    public function rates(): HasMany
    {
        //fixme define return type for functions *done
        return $this->hasMany(Rate::class);
    }

    //fixme define return type for functions *done
    //todo move business logic to service layer
    //fixme use dtos instead of maps for data transferring
    #[ArrayShape(['rate' => "float|string", 'color' => "string"])] public function performance(): array
    {
        $breakfastsDone = $this->breakfasts;
        $counter = 0;
        $sum = 0;
        foreach ($breakfastsDone as $breakfast) {
            $counter += 1;
            $sum += $breakfast->avareageRate();
        }

        try {
            $performance = round($sum / $counter, 2);
        } catch (DivisionByZeroError) {
            $performance = "No rates yet !"; //todo use translations for user messages
        }

        if ($performance >= 1 && $performance <= 4) {
            return ['rate' => $performance, 'color' => "#ff8080"]; //todo move view elements to view layer
        } elseif ($performance > 4 && $performance <= 6) {
            return ['rate' => $performance, 'color' => "#f6c23e"];
        } elseif ($performance > 6 && $performance <= 10) {
            return ['rate' => $performance, 'color' => "#1cc88a"];
        } else {
            return ['rate' => $performance, 'color' => "#f8f9fc"];
        }

    }

    //todo move business logic to service layer
    //fixme define return type for functions *done
    public function viewAvatar(): string|UrlGenerator|Application
    {
        $url = url($this->avatar);
        if (str_contains($url, 'default.svg')) {
            return $url;
        } else {
            return asset(Storage::url($this->avatar));
        }
    }

    public function countBreakfasts()
    {
        //fixme define return type for functions
        return $this->breakfasts->whereNull('deleted_at')->count();
    }


    //fixme define return type for functions *done
    //todo move business logic to service layer
    public function averAgeParticipating(): float
    {
        $breakfastCounts = $this->breakfasts->whereNull('deleted_at')->count();
        $userCreatedAt = Carbon::createFromFormat('Y-m-d  H:i:s', $this->created_at);
        $now = Carbon::now();
        $diff = $userCreatedAt->diffInDays($now) + 1;
        return round($breakfastCounts / $diff, 3);
    }

}
