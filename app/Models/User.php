<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use \Morilog\Jalali\Jalalian ;
use Illuminate\Database\Eloquent\Casts\Attribute;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    use SoftDeletes ;
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

    public function breakfasts(){
        return $this->hasMany(Breakfast::class) ;
    }

    public function rates(){
        return $this->hasMany(Rate::class);
    }

    public function performance(){
        $breakfasts_done = $this -> breakfasts ;
        $counter = 0 ;
        $sum = 0 ;
        foreach ($breakfasts_done as $breakfast){
            $counter += 1 ;
            $sum += $breakfast->avareageRate() ;
        }

        try {
            $performance =  round($sum/$counter , 2 ) ;
        }catch (\DivisionByZeroError ){
            $performance =  "No rates yet !";
        }

        if($performance >=1  && $performance <= 4) {
            return ['rate'=>$performance , 'color'=>"#ff8080"] ;
        }
        elseif ($performance >4  && $performance <= 6){
            return ['rate'=>$performance , 'color'=>"#f6c23e"] ;
        }
        elseif ($performance >6  && $performance <= 10){
            return ['rate'=>$performance , 'color'=>"#1cc88a"] ;
        }
        else{
            return  ['rate'=>$performance , 'color'=>"#f8f9fc"] ;
        }

    }

    public function viewAvatar(){

       return $contents = Storage::url($this->avatar);
    }

    public function countBreakfasts(){
        $count = 0 ;
        $brekfasts = Breakfast::all() ;
        foreach ($brekfasts as $brekfast){
            if($brekfast->user_id === $this->id) {
                $count += 1 ;
            }
        }

        return $count ;
    }


    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Jalalian::forge($value)->format('%A, %d %B %Y'),

        );
    }




}
