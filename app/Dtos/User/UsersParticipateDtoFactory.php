<?php

namespace App\Dtos\User;

use App\Services\User\UsersParticipateAverageService;
use function resolve;

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
