<?php

namespace App\Dtos;

use App\Models\User;
use JetBrains\PhpStorm\Pure;

class UserBreakfastDtoFactory
{
    //todo use static methods in dto facilities *done
    #[Pure] public static function fromModel(User $model, ?float $averAgeParticipating): UserBreakfastDto
    {
        return new UserBreakfastDto(
            $model->id,
            $model->name,
            $averAgeParticipating
        );
    }

}
