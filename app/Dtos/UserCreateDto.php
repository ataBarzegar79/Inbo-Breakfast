<?php

namespace App\Dtos ;

class UserCreateDto{

    public function __construct(
        public string      $name,
        public string      $email,
        public string      $password,
        public string      $avatar,
        public string      $is_admin,
    )
    {

    }

}
