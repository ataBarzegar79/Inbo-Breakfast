<?php

namespace App\Dtos\Request;

use App\Http\Requests\LoginRequest;
use JetBrains\PhpStorm\Pure;


class LoginRequestDtoFactory
{
    #[Pure] public static function fromRequest(LoginRequest $request): LoginRequestDto
    {
        return new LoginRequestDto(
            $request->name,
            $request->password,
        );
    }
}
