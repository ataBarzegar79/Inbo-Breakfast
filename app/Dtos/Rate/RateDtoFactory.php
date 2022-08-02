<?php

namespace App\Dtos\Rate;

use App\Models\Rating;
use JetBrains\PhpStorm\Pure;

class RateDtoFactory
{
    #[Pure] public static function fromModel(Rating $rate): RateDto
    {
        return new RateDto(
            $rate->id,
            $rate->rate,
            $rate->description
        );
    }

}









