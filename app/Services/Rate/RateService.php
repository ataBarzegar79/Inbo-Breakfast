<?php

namespace App\Services\Rate;

use App\Dtos\Breakfast\BreakfastUpdateDto;
use App\Dtos\VoteRequestDto;
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
     * @param VoteRequestDto $dto
     * @param Breakfast $breakfsatvote
     * @return void
     */
    //fixme use camelcase for function parameters:Done
    public function store(VoteRequestDto $dto, Breakfast $breakfsatvote): void;

}
