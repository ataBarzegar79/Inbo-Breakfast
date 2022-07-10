<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Jalalian::forge($value)->format('%A, %d %B %Y'),
//            get: fn ($value) => 1 ,
        );
    }

}
