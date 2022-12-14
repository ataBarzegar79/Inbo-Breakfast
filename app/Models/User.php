<?php

namespace App\Models;

use App\Dtos\Request\LoginRequestDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
 * @method static auth(LoginRequestDto $dto)
 * @method static where(string $string, int $userId)
 * @method static paginate(int $int)
 * @method static select(string $string)
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
        return $this->belongsToMany(Breakfast::class)->withTrashed();
    }

    public function rates(): HasMany
    {
        return $this->hasMany(Rating::class);
    }



}
