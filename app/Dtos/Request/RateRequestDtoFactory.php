<?php

namespace App\Dtos\Request;

use App\Http\Requests\StoreRateRequest;
use JetBrains\PhpStorm\Pure;

class RateRequestDtoFactory
{
    #[Pure] public static function fromRequest(StoreRateRequest $request): RateRequestDto
    {
        return new RateRequestDto(
            $request->rate,
            $request->description,
        );
    }
}
