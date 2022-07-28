<?php

namespace App\Services;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;

interface UserSupportService
{
    /**
     * @param int $userId
     * @return mixed
     */
    public function performance(int $userId, float $averageRate): mixed;

    /**
     * @param int $userId
     * @param float|string $performance
     * @return mixed
     */
    public function performanceColor(int $userId, float|string $performance): mixed;

    /**
     * @param int $userId
     * @return string|UrlGenerator|Application
     */
    public function viewAvatar(int $userId): string|UrlGenerator|Application;

    /**
     * @param int $userId
     * @return int
     */
    public function countBreakfasts(int $userId): int;

    /**
     * @param int $userId
     * @return float
     */
    public function averAgeParticipating(int $userId): float;
}
