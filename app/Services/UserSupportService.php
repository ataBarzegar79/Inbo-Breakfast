<?php

namespace App\Services;

interface UserSupportService
{
    /**
     * @param int $userId
     * @return mixed
     */
    public function performance(int $userId): mixed;

    public function performanceColor(int $userId, UserSupportService $service);
}
