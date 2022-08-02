<?php

namespace App\Dtos\Request;

class VoteRequestDto
{
    public function __construct(
        public float  $rate,
        public string $description,
    )
    {
    }
}
