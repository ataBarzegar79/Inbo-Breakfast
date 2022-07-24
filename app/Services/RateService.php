<?php

namespace App\Services ;

use App\Dtos\BreakfastDto;
use App\Http\Requests\storeVoteRequest;

interface  RateService {
    /**
     * @param int $breakfast_id
     * @return BreakfastDto
     */
    public function create(int $breakfast_id) : BreakfastDto ;


    public function store(storeVoteRequest $request , int $breakfast_id ) : void ;


}
