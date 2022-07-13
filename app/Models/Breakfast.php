<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use \Morilog\Jalali\Jalalian ;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;



class Breakfast extends Model
{
    use HasFactory;
    use SoftDeletes ;
    protected  $table = 'breakfasts' ;
    protected $fillable = [
        'name',
        'description',
        'created_at',
        'user_id'
    ];
    public function rates()
    {
        return $this->hasMany(Rate::class) ;
    }

    public function user(){

        return $this->belongsTo(User::class)->withTrashed(); ;
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
            set: fn ($value) => (new Jalalian($value[0], $value[1], $value[2], 0, 0, 0))->toCarbon()->toDateTimeString()  ,
        );
    }

}
