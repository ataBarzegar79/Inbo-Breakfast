<?php

namespace App\Dtos;

use App\Models\Breakfast;
use App\Models\Rate;

class BreakfastDtoFactory
{
    //todo use static methods in dto facilities *done
    public static function fromModel(Breakfast $model, ?Rate $rate): BreakfastDto
    {
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
            $model->created_at,
            $items,
            $model->avareageRate(),
            $rateDto
        );
    }

}
