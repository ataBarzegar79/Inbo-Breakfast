<?php

namespace App\Models;

use Carbon\Carbon;
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
        return $this->belongsToMany(Breakfast::class)->withTrashed() ;
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

       $url =url($this->avatar);
       if(str_contains($url , 'default.svg')){
           return $url ;
       }
       else{
           return asset(Storage::url($this->avatar)) ;
       }
    }

    public function countBreakfasts(){
        return $this->breakfasts->whereNull('deleted_at')->count() ;
//           return $this ->breakfasts->count() ;
    }


    public function averAgeParticipating()
    {

        $berakfast_counts = $this->breakfasts->whereNull('deleted_at')->count();
        $user_created_at = Carbon::createFromFormat('Y-m-d  H:i:s' , $this->created_at );
        $now = Carbon::now();
        $diff = $user_created_at->diffInDays($now) + 1;
        return round($berakfast_counts/$diff,3) ;

    }



}
