<?php

namespace App\Services\User;

use App\Models\User;

class UsersParticipateAverageServiceConcrete implements UsersParticipateAverageService
{
    public function participateAverage(): float
    {
        $users = User::select('id')->get();
        $usersCount = count($users);
        $userSupport = resolve(UserSupportService::class);
        $sum = 0;
        foreach ($users as $user) {
            $sum += $userSupport->userAverAgeParticipating($user->id);
        }
        return round($sum / $usersCount, 2);
    }
}
