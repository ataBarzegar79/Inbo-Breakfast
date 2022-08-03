<?php

namespace App\Services\User;

use App\Models\User;

interface UserPerformanceService
{
    /**
     * @param User $user
     * @return mixed
     */
    public function performance(User $user): mixed;
}
