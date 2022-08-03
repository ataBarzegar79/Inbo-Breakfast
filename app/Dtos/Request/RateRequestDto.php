<?php

namespace App\Dtos\Request;

class RateRequestDto
{
    public function __construct(
        public float  $rate,
        public string $description,
    )
    {
    }
}
