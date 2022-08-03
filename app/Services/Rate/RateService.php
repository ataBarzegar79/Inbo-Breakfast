<?php

namespace App\Services\Rate;

use App\Dtos\Breakfast\BreakfastUpdateDto;
use App\Dtos\Request\RateRequestDto;
use App\Models\Breakfast;

interface  RateService
{
    /**
     * @param Breakfast $breakfsatvote
     * @return BreakfastUpdateDto
     */
    public function create(Breakfast $breakfsatvote): BreakfastUpdateDto;

    /**
     * @param RateRequestDto $dto
     * @param Breakfast $breakfsatvote
     * @return void
     */
    public function store(RateRequestDto $dto, Breakfast $breakfsatvote): void;

}
