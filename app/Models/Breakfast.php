<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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


}
