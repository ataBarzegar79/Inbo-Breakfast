<?php

namespace App\Dtos;

use phpDocumentor\Reflection\Types\Boolean;
//fixme cleanup unused imports

class UserDto
{

    //fixme use consistent naming conventions
    public function __construct(
        public int       $id,
        public string    $name,
        public string    $email,
        public string    $password,
        public string    $created_at,
        public string    $is_admin,
        public string    $avatar,
        public string    $rate,
        public string    $color,
        public float     $averageParticipating,
        public int       $countBreakfast,
    )
    {
    }

}
