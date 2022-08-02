<?php

namespace App\Dtos;

class UserDto
{
    public function __construct(
        public float  $averageParticipating,
        public int    $id,
        public string $name,
        public string $email,
        public string $password,
        public string $createdAt,
        public string $isAdmin,
        public string $avatar,
        public string $rate,
        public string $color,
        public int    $countBreakfast,
    )
    {
    }

}
