<?php

namespace App\Dtos;

//fixme cleanup unused imports *done

class UserDto
{
    //fixme use consistent naming conventions *done
    public function __construct(
        public int    $id,
        public string $name,
        public string $email,
        public string $password,
        public string $createdAt,
        public string $isAdmin,
        public string $avatar,
        public string $rate,
        public string $color,
        public float  $averageParticipating,
        public int    $countBreakfast,
    )
    {
    }

}
