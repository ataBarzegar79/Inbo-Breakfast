<?php

namespace App\Services\Auth;

use App\Dtos\Request\LoginRequestDto;
use Illuminate\Support\Facades\Auth;
use function request;

class AuthServiceConcrete implements AuthService
{

    public function login(LoginRequestDto $dto): bool
    {

        if (Auth::attempt(['name'=> $dto->name , 'password'=> $dto->password])) {
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
