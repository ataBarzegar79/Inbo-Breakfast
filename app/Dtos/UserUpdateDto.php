<?php

namespace App\Dtos;

class UserUpdateDto
{
    public function __construct(
        public int    $id,
        public string $name,
        public string $email,
        public string $password,
        public string $avatar,
        public string $is_admin,
    )
    {
    }
}
