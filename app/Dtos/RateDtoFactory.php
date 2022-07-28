<?php

namespace App\Dtos;

use App\Models\Rate;
use JetBrains\PhpStorm\Pure;

class RateDtoFactory
{
    //todo use static methods in dto facilities *done
    //fixme define return type for functions *done
    #[Pure] public static function fromModel(Rate $rate): RateDto
    {
        return new RateDto(
            $rate->id,
            $rate->rate,
            $rate->description
        );
    }

}









