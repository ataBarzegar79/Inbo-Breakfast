<?php

namespace App\Services\Rate;

use App\Dtos\Breakfast\BreakfastDto;
use App\Dtos\Breakfast\BreakfastUpdateDto;
use App\Dtos\VoteRequestDto;
use App\Http\Requests\StoreVoteRequest;
use App\Models\Breakfast;

interface  RateService
{
    /**
     * @param Breakfast $breakfsatvote
     * @return BreakfastUpdateDto
     */
    //fixme use camelcase for function parameters:Done
    public function create(Breakfast $breakfsatvote): BreakfastUpdateDto;

    /**
     * @param VoteRequestDto $request
     * @param Breakfast $breakfsatvote
     * @return void
     */
    //fixme use camelcase for function parameters:Done
    public function store(VoteRequestDto $request, Breakfast $breakfsatvote): void;

}
