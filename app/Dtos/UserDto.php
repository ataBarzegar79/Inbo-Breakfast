<?php
namespace App\Dtos ;

use App\Models\Breakfast;

class UserDto{
    public function __construct(
        public int          $id,
        public string       $name,
        public string       $email,
        public string       $created_at,
        public string       $password   ,
        public string       $is_admin ,
        public array        $breakfasts,
        public array        $rates,
        public array        $performance ,
        public string       $avatar_url ,
        public float        $avareage_participate
    )
    {
    }
}

