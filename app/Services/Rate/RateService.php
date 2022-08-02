<?php

namespace App\Services\Rate;

use App\Dtos\Breakfast\BreakfastUpdateDto;
use App\Dtos\Request\VoteRequestDto;
use App\Models\Breakfast;

interface  RateService
{
    /**
     * @param Breakfast $breakfsatvote
     * @return BreakfastUpdateDto
     */
    public function create(Breakfast $breakfsatvote): BreakfastUpdateDto;

    /**
     * @param VoteRequestDto $dto
     * @param Breakfast $breakfsatvote
     * @return void
     */
    public function store(VoteRequestDto $dto, Breakfast $breakfsatvote): void;

}
