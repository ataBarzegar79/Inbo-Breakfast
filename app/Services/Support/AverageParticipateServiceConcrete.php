<?php

namespace App\Services\Support;

use App\Models\User;

class AverageParticipateServiceConcrete implements AverageParticipateService
{
    public function averageParticipate(): float
    {
        $users = User::all();
        $usersCount = $users->count();
        $sum = 0;
        foreach ($users as $user) {
            $sum += $user->averAgeParticipating();
        }

        return round($sum / $usersCount, 3);
    }

}
