<?php

namespace App\Dtos;

use App\Models\Breakfast;
use App\Models\Rate;
use App\Services\Support\JalaliService;
use App\Services\UserSupportService;

class BreakfastDtoFactory
{
    //todo use static methods in dto facilities *done
    public static function fromModel(Breakfast $model, ?Rate $rate, UserSupportService $userSupportService): BreakfastDto
    {
        $service = resolve(JalaliService::class ,[$model->created_at]);
        $createdAt = $service->toPersian();
        $users = $model->users;
        $items = [];
        if ($rate !== null) {
            $rateDto = RateDtoFactory::fromModel($rate);
        } else {
            $rateDto = null;
        }

        foreach ($users as $user) {
            $averAgeParticipating = $userSupportService->averAgeParticipating($user->id);
            $items[] = UserBreakfastDtoFactory::fromModel($user, $averAgeParticipating);
        }

        return new BreakfastDto(
            $model->id,
            $model->name,
            $model->description,
            $createdAt,
            $items,
            $model->avareageRate(),
            $rateDto
        );
    }

}
