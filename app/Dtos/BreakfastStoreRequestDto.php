<?php

namespace App\Dtos;

class BreakfastStoreRequestDto
{
    public function __construct(
        public string $name,
        public string $description,
        public string $date, // fixme date datatype
        public array  $users
    )
    {
    }
}
