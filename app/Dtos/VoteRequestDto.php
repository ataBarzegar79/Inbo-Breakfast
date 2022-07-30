<?php

namespace App\Dtos;

class VoteRequestDto
{
    public function __construct(
        public float  $rate,
        public string $description,
    )
    {
    }
}
