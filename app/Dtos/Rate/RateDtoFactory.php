<?php

namespace App\Dtos\Rate;

use App\Models\Rate;
use JetBrains\PhpStorm\Pure;

class RateDtoFactory
{
    #[Pure] public static function fromModel(Rate $rate): RateDto
    {
        return new RateDto(
            $rate->id,
            $rate->rate,
            $rate->description
        );
    }

}









