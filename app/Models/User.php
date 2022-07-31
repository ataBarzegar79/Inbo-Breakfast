<?php

namespace App\Models;

use App\Dtos\LoginRequestDto;
use Carbon\Carbon;
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
 * @property mixed $name
 * @property mixed $email
 * @property mixed $password
 * @method static find(int $id)
 * @method static create(array $array)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';
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
    public function averAgeParticipating(): float
    {
        $breakfastCounts = $this->breakfasts->whereNull('deleted_at')->count();
        $userCreatedAt = Carbon::createFromFormat('Y-m-d  H:i:s', $this->created_at);
        $now = Carbon::now();
        $diff = $userCreatedAt->diffInDays($now) + 1;
        return round($breakfastCounts / $diff, 3);
    } // todo Ehsan: Delete this

    public function scopeAuth($query, LoginRequestDto $dto)
    {
        $query->where('name', '=', $dto->name)
            ->where('password', '=', $dto->password);
    }

}
