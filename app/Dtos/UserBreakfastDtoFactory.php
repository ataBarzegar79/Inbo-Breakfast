<?php

namespace App\Dtos;

use App\Models\User;
use App\Services\UserSupportService;

class UserBreakfastDtoFactory
{
    //todo use static methods in dto facilities *done
    public static function fromModel(User $model, UserSupportService $service): UserBreakfastDto
    {
        $averAgeParticipating = $service->averAgeParticipating($model->id);
        return new UserBreakfastDto(
            $model->id,
            $model->name,
            $averAgeParticipating
        );
    }

}
