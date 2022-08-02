<?php

namespace App\Dtos\Request;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use JetBrains\PhpStorm\Pure;

class UserRequestDtoFactory
{
    #[Pure] public static function fromRequest(StoreUserRequest|UpdateUserRequest $request): UserRequestDto
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
