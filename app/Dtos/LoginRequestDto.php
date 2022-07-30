<?php

namespace App\Dtos;

class LoginRequestDto
{
    public function __construct(
        public string $name,
        public string $password,
    )
    {
    }
}
