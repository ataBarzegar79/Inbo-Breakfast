<?php

namespace App\Dtos;

use App\Models\User;


class UserDtoFactory
{
    public function fromModel(User $model): UserDto
    {
        return new UserDto(
            $model->id,
            $model->name,
            $model->email,
            $model->created_at,
            $model->password,
            $model->is_admin,
            [1,2,3],
            [1,2,3],
            $model->performance(),
            $model->viewAvatar(),
            $model->averAgeParticipating()
        );

    }
}

