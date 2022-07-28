<?php

namespace App\Dtos;

//fixme cleanup unused imports *done

class UserBreakfastDto
{
    /**
     * @param int $id
     * @param string $name
     * @param float|null $average gives average participating for each user
     */
    public function __construct(
        public int    $id,
        public string $name,
        public ?float  $average,
    )
    {
    }
}
