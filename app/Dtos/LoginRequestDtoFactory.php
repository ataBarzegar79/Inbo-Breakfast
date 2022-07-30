<?php

namespace App\Dtos;

use Request;
use JetBrains\PhpStorm\Pure;


class LoginRequestDtoFactory
{
    #[Pure] public static function fromRequest(Request $request): LoginRequestDto
    {
        return new LoginRequestDto(
            $request->name,
            $request->password,
        );
    }
}
