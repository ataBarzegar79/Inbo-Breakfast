<?php

namespace App\Dtos;

class  BreakfastUpdateDto
{
    /**
     * @param int $id breakfast id
     * @param string $name breakfast name
     * @param array $doers array with breakfast dto doers items
     */
    public function __construct(
        public int    $id,
        public string $name,
        public array  $doers
    )
    {
    }
}
