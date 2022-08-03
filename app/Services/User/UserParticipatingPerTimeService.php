<?php

namespace App\Services\User;

use App\Models\User;

interface UserParticipatingPerTimeService
{
    /**
     * @param User $user
     * @return float
     */
    public function userParticipatingPerTime(User $user): float;
}
