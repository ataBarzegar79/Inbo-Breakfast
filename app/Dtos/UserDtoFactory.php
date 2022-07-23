<?php

namespace App\Dtos;

use App\Models\User;

class UserDtoFactory
{
    public function fromModel(User $user): UserDto
    {
return new UserDto(
    $user->id,
    $user->name,
    $user->email,
    $user->created_at,
    $user->is_admin,
    $user->avatar,
);
}
}
