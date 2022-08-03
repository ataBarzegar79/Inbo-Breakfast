<?php

namespace App\Services\User;

use App\Models\User;

class UserCountBreakfastsServiceConcrete implements UserCountBreakfastsService
{
    public function countBreakfasts(User $user): int
    {
        return $user->breakfasts->count();
    }
}
