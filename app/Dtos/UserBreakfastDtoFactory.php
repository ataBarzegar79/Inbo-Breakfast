<?php

namespace App\Dtos;

use App\Models\User;
use JetBrains\PhpStorm\Pure;

class UserBreakfastDtoFactory
{
    #[Pure] public static function fromModel(User $model, ?float $averAgeParticipating): UserBreakfastDto
    {
        return new UserBreakfastDto(
            $model->id,
            $model->name,
            $averAgeParticipating
        );
    }

}
