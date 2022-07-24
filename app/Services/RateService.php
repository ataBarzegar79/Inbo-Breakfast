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

    /**
     * @param storeVoteRequest $request
     * @param int $breakfast_id
     * @return void  returns nothing , just saves the rate and description in DB .
     */
    public function store(storeVoteRequest $request , int $breakfast_id ) : void ;


}
