<?php

namespace App\Dtos\Breakfast;

class BreakfastDoerDto
{
    /**
     * @param int $id
     * @param string $name
     */
    public function __construct(
        public int    $id,
        public string $name,
    )
    {
    }

}
