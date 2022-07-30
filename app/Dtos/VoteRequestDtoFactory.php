<?php

namespace App\Dtos;

use App\Http\Requests\StoreVoteRequest;
use JetBrains\PhpStorm\Pure;

class VoteRequestDtoFactory
{
    #[Pure] public static function fromRequest(StoreVoteRequest $request): VoteRequestDto
    {
        return new VoteRequestDto(
            $request->rate,
            $request->description,
        );
    }
}
