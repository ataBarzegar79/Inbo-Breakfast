<?php

namespace App\Dtos;

class BreakfastStoreRequestDto
{
    public function __construct(
        public string $name,
        public string $description,
        public string $date,
        public array  $users
    )
    {
    }
}
