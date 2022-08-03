<?php

namespace App\Services\User;

use App\Models\User;

class UsersParticipateAverageServiceConcrete implements UsersParticipateAverageService
{
    public function participateAverage(): float
    {
        $users = User::all();
        $usersCount = count($users);
        $userParticipatingPerTimeService = resolve(UserParticipatingPerTimeService::class);
        $sum = 0;
        foreach ($users as $user) {
            $sum += $userParticipatingPerTimeService->userParticipatingPerTime($user);
        }
        return round($sum / $usersCount, 2);
    }
}
