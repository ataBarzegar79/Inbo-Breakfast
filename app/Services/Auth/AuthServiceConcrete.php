<?php

namespace App\Services\Auth;

use App\Dtos\LoginRequestDto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use function request;

class AuthServiceConcrete implements AuthService
{

    public function login(LoginRequestDto $dto): bool
    {
        $user = User::auth($dto)->first();
        if ($user) {
            Auth::login($user);
            request()->session()->regenerate();
            return true;
        }
        return false;

    }

    public function logout(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}
