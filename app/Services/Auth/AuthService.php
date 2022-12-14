<?php

namespace App\Services\Auth;

use App\Dtos\Request\LoginRequestDto;

interface AuthService
{
    /**
     * @param LoginRequestDto $dto
     * @return bool  true -> redirect to main page , false-> redirect back with error message
     */
    public function login(LoginRequestDto $dto): bool;

    /**
     * @return void
     */
    public function logout(): void;

}
