<?php
namespace App\Dtos ;

use App\Models\Breakfast;

class UserBreakfastDto{
    public function __construct(
        public int          $id,
        public string       $name,
        public float        $average ,
    )
    {
    }
}

