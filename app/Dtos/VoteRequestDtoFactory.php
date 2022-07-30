<?php

namespace App\Dtos;

use Illuminate\Support\Facades\Request;
use JetBrains\PhpStorm\Pure;

class VoteRequestDtoFactory
{
    #[Pure] public static function fromRequest(Request $request): VoteRequestDto
    {
        return new VoteRequestDto(
            $request->rate,
            $request->description,
        );
    }
}
