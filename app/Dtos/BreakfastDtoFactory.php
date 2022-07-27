<?php

namespace App\Dtos;

use App\Models\Breakfast;
use App\Models\Rate;
use App\Services\BreakfastSupportService;
use App\Services\Support\JalaliService;

class BreakfastDtoFactory
{
    //todo use static methods in dto facilities *done
    public static function fromModel(Breakfast $model, ?Rate $rate): BreakfastDto
    {
        $jalaliService = resolve(JalaliService::class, [$model->created_at]);
        $createdAt = $jalaliService->toPersian();


        $breakfastSupport = resolve(BreakfastSupportService::class, [$model]);
        $averageRate = $breakfastSupport->averageRate();


        $users = $model->users;
        $items = [];
        if ($rate !== null) {
            $rateDto = RateDtoFactory::fromModel($rate);
        } else {
            $rateDto = null;
        }

        foreach ($users as $user) {
            $items[] = UserBreakfastDtoFactory::fromModel($user);
        }

        return new BreakfastDto(
            $model->id,
            $model->name,
            $model->description,
            $createdAt,
            $items,
            $averageRate,
            $rateDto
        );
    }

}
