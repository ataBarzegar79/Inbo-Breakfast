<?php

namespace App\Services ;

use App\Dtos\BreakfastDto;
use App\Http\Requests\storeVoteRequest;

interface  RateService {
    /**
     * @param int $breakfast_id
     * @return BreakfastDto
     */
    //fixme use camelcase for function parameters
    public function create(int $breakfast_id) : BreakfastDto ;


    //fixme use camelcase for function parameters
    public function store(storeVoteRequest $request , int $breakfast_id ) : void ;


}
