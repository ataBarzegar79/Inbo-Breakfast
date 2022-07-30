<?php

namespace App\Dtos;


use App\Http\Requests\StoreBreakfastRequest;
use JetBrains\PhpStorm\Pure;

/**
 * @property $name
 * @property $description
 * @property $date
 * @property $users
 */
class BreakfastStoreRequestDtoFactory
{
    #[Pure] public static function fromRequest(StoreBreakfastRequest $request): BreakfastStoreRequestDto
    {
        return new BreakfastStoreRequestDto(
            $request->name,
            $request->description,
            $request->date,
            $request->users,
        );
    }
}
