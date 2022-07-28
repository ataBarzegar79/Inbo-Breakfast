<?php

namespace App\Dtos;

class BreakfastDoerDto
{
    /**
     * @param int $id
     * @param string $name
     */
    public function __construct(
        public int      $id,
        public string   $name,
    )
    {
    }

}
