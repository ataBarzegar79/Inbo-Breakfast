<?php

namespace App\Dtos;

use Illuminate\Support\Facades\Request;
use JetBrains\PhpStorm\Pure;

class UserRequestDtoFactory
{
    #[Pure] public static function fromRequest(Request $request): UserRequestDto
    {
        return new UserRequestDto(
            $request->name,
            $request->email,
            $request->password,
            $request->avatar,
            $request->is_admin,
        );
    }
}
