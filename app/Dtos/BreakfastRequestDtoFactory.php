<?php

namespace App\Dtos;


use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;

/**
 * @property $name
 * @property $description
 * @property $date
 * @property $users
 */
class BreakfastRequestDtoFactory
{
    #[Pure] public static function fromRequest(Request $request): BreakfastRequestDto
    {
        return new BreakfastRequestDto(
            $request->name,
            $request->description,
            $request->date,
            $request->users,
        );
    }
}
