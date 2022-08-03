<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;

interface UserViewAvatarService
{
    /**
     * @param User $user
     * @return string|UrlGenerator|Application
     */
    public function viewAvatar(User $user): string|UrlGenerator|Application;
}
