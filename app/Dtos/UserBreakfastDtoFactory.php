<?php

namespace App\Dtos;

use App\Models\User;


class UserBreakfastDtoFactory
{
    //todo use static methods in dto facilities
    public function fromModel(User $model): UserBreakfastDto
    {
        return new UserBreakfastDto(
            $model->id,
            $model->name,
            $model->averAgeParticipating()
        );

    }
}

