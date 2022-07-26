<?php

namespace App\Dtos ;

use App\Models\Rate;

class RateDtoFactory{

    //todo use static methods in dto facilities
    //fixme define return type for functions
    public function fromModel(Rate  $rate){

            return new RateDto(
                $rate->id ,
                $rate->rate,
                $rate->description
            ) ;
    }
}

