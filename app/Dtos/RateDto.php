<?php

namespace App\Dtos;

class RateDto
{
    public function __construct(
        public int    $id,
        public int    $rate,
        public string $description
    )
    {
    }
}
