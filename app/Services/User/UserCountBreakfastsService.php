<?php

namespace App\Services\User;

use App\Models\User;

interface UserCountBreakfastsService
{
    /**
     * @param User $user
     * @return int
     */
    public function countBreakfasts(User $user): int;
}
