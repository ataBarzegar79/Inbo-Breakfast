<?php

namespace App\Services\User;

use App\Models\User;
use Carbon\Carbon;

class UserParticipatingPerTimeServiceConcrete implements UserParticipatingPerTimeService
{
    public function userParticipatingPerTime(User $user): float
    {
        $breakfastCounts = $user->breakfasts->count(); //scopes
        $userCreatedAt = Carbon::createFromFormat('Y-m-d  H:i:s', $user->created_at);
        $now = Carbon::now();
        $diff = $userCreatedAt->diffInDays($now) + 1;

        return round($breakfastCounts / $diff, 3);
    }

}
