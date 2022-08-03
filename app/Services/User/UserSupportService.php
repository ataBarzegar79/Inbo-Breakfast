<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;

interface UserSupportService
{
    /**
     * @param User $user
     * @return mixed
     */
    public function performance(User $user): mixed;


    /**
     * @param User $user
     * @return string|UrlGenerator|Application
     */
    public function viewAvatar(User $user): string|UrlGenerator|Application;

    /**
     * @param User $user
     * @return int
     */
    public function countBreakfasts(User $user): int;

    /**
     * @param User $user
     * @return float
     */
    public function userAverAgeParticipating(User $user): float;
}
