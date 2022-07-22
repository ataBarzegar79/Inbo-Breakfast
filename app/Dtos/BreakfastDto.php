<?php

namespace App\Dtos;

class BreakfastDto
{
    public function __construct(
        public int          $id,
        public string       $name,
        public string       $description,
        public string       $created_at,
        public array        $users,
        public float        $averageRate,
        public array $userRate)
    {

    }


}

