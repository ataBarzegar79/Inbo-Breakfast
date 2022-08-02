<?php

namespace App\Dtos\Request;

class LoginRequestDto
{
    public function __construct(
        public string $name,
        public string $password,
    )
    {
    }
}
