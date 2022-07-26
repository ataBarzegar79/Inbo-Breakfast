<?php

namespace App\Services ;

use App\Dtos\BreakfastDto;
use App\Http\Requests\StoreVoteRequest;

interface  RateService {
    /**
     * @param int $breakfast_id
     * @return BreakfastDto
     */
    //fixme use camelcase for function parameters
    public function create(int $breakfast_id) : BreakfastDto ;


    //fixme use camelcase for function parameters
    public function store(StoreVoteRequest $request , int $breakfast_id ) : void ;


}
