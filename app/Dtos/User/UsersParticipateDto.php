<?php

namespace App\Dtos\User;

class UsersParticipateDto
{
    public function __construct(
        public float $usersAverage
    )
    {
    }
}
