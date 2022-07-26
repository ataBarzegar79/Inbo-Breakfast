<?php

namespace App\Dtos;

class BreakfastDto
{
    public function __construct(
        public int      $id,
        public string   $name,
        public string   $description,
        public string   $createdAt,
        public array    $users,
        public float    $averageRate,
        public ?RateDto $userRate,
    )
    {
    }

}
