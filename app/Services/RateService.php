<?php

namespace App\Services;

use App\Dtos\BreakfastDto;
use App\Http\Requests\StoreVoteRequest;

interface  RateService
{
    /**
     * @param int $breakfastId
     * @return BreakfastDto
     */
    //fixme use camelcase for function parameters:Done
    public function create(int $breakfastId): BreakfastDto;

    /**
     * @param StoreVoteRequest $request
     * @param int $breakfastId
     * @return void
     */
    //fixme use camelcase for function parameters:Done
    public function store(StoreVoteRequest $request, int $breakfastId): void;

}
