<?php

namespace App\Dtos;


use App\Models\User;
use JetBrains\PhpStorm\Pure;

class UserUpdateDtoFactory
{
    /**
     * @param User $user
     * @return UserUpdateDto
     */
    #[Pure] public static function fromModel(User $user): UserUpdateDto
    {
        return new UserUpdateDto(
            $user->id,
            $user->name,
            $user->email,
            $user->password,
            $user->avatar,
            $user->is_admin,
        );
    }
}
