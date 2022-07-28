<?php

namespace App\Dtos;




use App\Models\User;

class BreakfastDtoDoerFactory
{
    /**
     * @param User $user
     * @return BreakfastDoerDto
     */
    public static function fromModel(User $user): BreakfastDoerDto
    {
        return new BreakfastDoerDto(
            $user->id,
            $user->name,
        );
    }
}
