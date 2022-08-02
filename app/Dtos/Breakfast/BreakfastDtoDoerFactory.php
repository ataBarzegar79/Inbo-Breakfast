<?php

namespace App\Dtos\Breakfast;


use App\Models\User;
use JetBrains\PhpStorm\Pure;

class BreakfastDtoDoerFactory
{
    /**
     * @param User $user
     * @return BreakfastDoerDto
     */
    #[Pure] public static function fromModel(User $user): BreakfastDoerDto
    {
        return new BreakfastDoerDto(
            $user->id,
            $user->name,
        );
    }
}
