<?php

namespace App\Dtos;

use App\Models\User;

class UserBreakfastDtoFactory
{
    //todo use static methods in dto facilities *done
    public static function fromModel(User $model): UserBreakfastDto
    {
        return new UserBreakfastDto(
            $model->id,
            $model->name,
            $model->averAgeParticipating()
        );
    }

}
