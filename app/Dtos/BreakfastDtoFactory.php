<?php

namespace App\Dtos;

use App\Models\Breakfast;


class BreakfastDtoFactory
{
    //todo use static methods in dto facilities *done
    public static function fromModel(Breakfast $breakfast,string $persianCreatedAt , string|float $averageRate , array $doers , ?RateDto $rateDto): BreakfastDto
    {
        return new BreakfastDto(
            $breakfast->id,
            $breakfast->name,
            $breakfast->description,
            $persianCreatedAt,
            $doers,
            $averageRate,
            $rateDto
        );






















//        $jalaliService = resolve(JalaliService::class, [$model->created_at]);
//        $createdAt = $jalaliService->toPersian();
//
//
//        $breakfastSupport = resolve(BreakfastSupportService::class, [$model]);
//        $averageRate = $breakfastSupport->averageRate();
//
//
//        $users = $model->users;
//
//        if ($rate !== null) {
//            $rateDto = RateDtoFactory::fromModel($rate);
//        } else {
//            $rateDto = null;
//        }
//
//        foreach ($users as $user) {
//            if ($userSupportService === null) {
//                $averAgeParticipating = null;
//            } else {
//                $averAgeParticipating = $userSupportService->averAgeParticipating($user->id);
//            }
//
//            $doers[] = UserBreakfastDtoFactory::fromModel($user, $averAgeParticipating);
//        }
    }
}

