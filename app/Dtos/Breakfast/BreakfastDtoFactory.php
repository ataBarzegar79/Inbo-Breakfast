<?php

namespace App\Dtos\Breakfast;

use App\Dtos\Rate\RateDto;
use App\Models\Breakfast;
use JetBrains\PhpStorm\Pure;


class BreakfastDtoFactory
{
    #[Pure] public static function fromModel(
        Breakfast    $breakfast,
        string       $persianCreatedAt,
        string|float $averageRate,
        array        $doers,
        ?RateDto     $rateDto
    ): BreakfastDto
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

// todo delete commented code
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

