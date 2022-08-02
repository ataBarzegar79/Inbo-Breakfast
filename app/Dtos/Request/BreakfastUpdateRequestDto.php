<?php

namespace App\Dtos\Request;

class BreakfastUpdateRequestDto
{
    public function __construct(
        public string $name,
        public string $description,
        public array  $users
    )
    {
    }
}
