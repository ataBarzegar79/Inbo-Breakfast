<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\Storage;

class UserViewAvatarServiceConcrete implements UserViewAvatarService
{
    public function viewAvatar(User $user): string|UrlGenerator|Application
    {
        $url = url($user->avatar);
        if (str_contains($url, 'default.jpg')) {
            return $url;
        } else {
            return asset(Storage::url($user->avatar));
        }
    }
}
