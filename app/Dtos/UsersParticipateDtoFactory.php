<?php

namespace App\Dtos;

use App\Services\User\UsersParticipateAverageService;

class UsersParticipateDtoFactory
{
    public function usersAverage(): UsersParticipateDto
    {
        $average = resolve(UsersParticipateAverageService::class);
        return new UsersParticipateDto(
            $average->participateAverage
        );
    }
}
