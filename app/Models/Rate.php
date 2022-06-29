<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
    protected $table = 'ratings';
    public function breakfast()
    {
        return $this->belongsTo(Breakfast::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
