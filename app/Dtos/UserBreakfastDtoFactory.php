<?php

namespace App\Dtos;

use App\Models\User;


class UserBreakfastDtoFactory
{
    public function fromModel(User $model): UserBreakfastDto
    {
        return new UserBreakfastDto(
            $model->id,
            $model->name,
            $model->averAgeParticipating()
        );

    }
}

