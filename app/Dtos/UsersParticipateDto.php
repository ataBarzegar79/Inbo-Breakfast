<?php

namespace App\Dtos;

class UsersParticipateDto
{
    public function __construct(
        public float $usersAverage
    )
    {
    }
}
