<?php

namespace App\Services;

use App\Dtos\BreakfastDto;
use App\Http\Requests\StoreVoteRequest;

interface  RateService
{
    /**
     * @param int $breakfast_id
     * @return BreakfastDto
     */
    //fixme use camelcase for function parameters:Done
    public function create(int $breakfastId): BreakfastDto;

    /**
     * @param storeVoteRequest $request
     * @param int $breakfastId
     * @return void
     */
    //fixme use camelcase for function parameters:Done
    public function store(storeVoteRequest $request, int $breakfastId): void;

}
