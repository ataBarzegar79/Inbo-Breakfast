<?php

namespace App\Dtos\Breakfast;

use App\Models\Breakfast;

class BreakfastUpdateDtoFactory
{
    /**\
     * @param Breakfast $breakfast
     * @param array $doers
     * @return BreakfastUpdateDto
     */
    public static function fromModel(Breakfast $breakfast, array $doers): BreakfastUpdateDto
    {
        return new BreakfastUpdateDto(
            $breakfast->id,
            $breakfast->name,
            $breakfast->description,
            $doers
        );
    }
}
