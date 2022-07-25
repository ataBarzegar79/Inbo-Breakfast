<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use \Morilog\Jalali\Jalalian ;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;


//todo document model parameters
class Breakfast extends Model
{
    use HasFactory;
    use SoftDeletes ;
    protected  $table = 'breakfasts' ; //todo table name is redundant
    protected $fillable = [
        'name',
        'description',
        'created_at',
        'user_id'
    ];
//
//    protected $casts = [
//        'created_at' => 'datetime',
//    ];

    //fixme define return type for functions
    public function rates()
    {
        return $this->hasMany(Rate::class) ;
    }

    //fixme define return type for functions
    //fixme: pay attention to indentations
        public function users(){

        return $this->belongsToMany(User::class)->withTrashed() ;
    }

    //todo move business logic to service layer
    //fixme define return type for functions
    public function avareageRate()
    {

        $rates = $this ->rates->avg('rate') ;
        return round($rates,2) ;

    }

    //fixme define return type for functions
    //todo remove unused functions
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

}
