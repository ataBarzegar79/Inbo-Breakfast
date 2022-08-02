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


    }
}

