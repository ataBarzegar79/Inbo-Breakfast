<?php

namespace App\Dtos\Request;


use App\Http\Requests\BreakfastUpdateRequest;
use JetBrains\PhpStorm\Pure;

/**
 * @property $name
 * @property $description
 * @property $users
 */
class BreakfastUpdateRequestDtoFactory
{
    #[Pure] public static function fromRequest(BreakfastUpdateRequest $request): BreakfastUpdateRequestDto
    {
        return new BreakfastUpdateRequestDto(
            $request->name,
            $request->description,
            $request->users,
        );
    }
}
