<?php

namespace App\Services\Rate;

use App\Dtos\Breakfast\BreakfastDto;
use App\Dtos\Breakfast\BreakfastUpdateDto;
use App\Dtos\VoteRequestDto;
use App\Http\Requests\StoreVoteRequest;

interface  RateService
{
    /**
     * @param int $breakfastId
     * @return BreakfastUpdateDto
     */
    //fixme use camelcase for function parameters:Done
    public function create(int $breakfastId): BreakfastUpdateDto;

    /**
     * @param VoteRequestDto $request
     * @param int $breakfastId
     * @return void
     */
    //fixme use camelcase for function parameters:Done
    public function store(VoteRequestDto $request, int $breakfastId): void;

}
