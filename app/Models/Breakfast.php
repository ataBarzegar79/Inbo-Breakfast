<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use \Morilog\Jalali\Jalalian ;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Breakfast extends Model
{
    use HasFactory;
    protected  $table = 'breakfasts' ;
    public function rates()
    {
        return $this->hasMany(Rate::class) ;
    }

    public function user(){
        return $this->belongsTo(User::class) ;
    }

    public function avareageRate()
    {

        $rates = $this ->rates->avg('rate') ;
        return round($rates,2) ;

    }

    public function userRate(){
        $user = Auth::user() ;
        $rates = $this->rates ;
        foreach ($rates as $rate){
            if($rate->user_id == $user ->id){
                return ['rate' => $rate->rate , 'description'=> $rate->description] ;
            }
        }
        return null;
}

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Jalalian::forge($value)->format('%A, %d %B %Y'),
//            get: fn ($value) => 1 ,
        );
    }

}
