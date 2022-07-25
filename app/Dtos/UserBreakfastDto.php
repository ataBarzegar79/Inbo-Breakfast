<?php
namespace App\Dtos ;

use App\Models\Breakfast;

class UserBreakfastDto{
    /**
     * @param int $id
     * @param string $name
     * @param float $average  gives average participating for each user
     */
    public function __construct(
        public int          $id,
        public string       $name,
        public float        $average ,
    )
    {
    }
}

