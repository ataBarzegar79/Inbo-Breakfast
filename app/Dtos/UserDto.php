<?php

namespace App\Dtos;

use phpDocumentor\Reflection\Types\Boolean;

class UserDto
{

    public function __construct(
        public int          $id,
        public string       $name,
        public string       $email,
        public string       $created_at,
        public Boolean      $is_admin,
        public string       $avatar
    )
    {
    }

}
