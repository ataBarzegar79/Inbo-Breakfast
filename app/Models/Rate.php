<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//todo document model parameters
class Rate extends Model
{
    use HasFactory;
    use SoftDeletes ;
    protected  $fillable =[
       'rate' ,
       'description' ,
       'user_id' ,
       'breakfast_id'
    ] ;
    protected $table = 'ratings';
    public function breakfast()//fixme define return type for functions
    {
        return $this->belongsTo(Breakfast::class);
    }

    public function user()//fixme define return type for functions
    {
        return $this->belongsTo(User::class);
    }
}
