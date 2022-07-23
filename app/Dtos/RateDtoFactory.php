<?php

namespace App\Dtos ;

use App\Models\Rate;

class RateDtoFactory{

    public function fromModel(Rate  $rate){

            return new RateDto(
                $rate->id ,
                $rate->rate,
                $rate->description
            ) ;
    }
}

