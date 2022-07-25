<?php

namespace App\Dtos;

use App\Models\Breakfast;
use App\Models\Rate;


class BreakfastDtoFactory
{
    public function fromModel(Breakfast $model ,?Rate $rate): BreakfastDto
    {   $users = $model->users ;
        $items = [] ;
        if($rate !== null) {
            $rate_factory = new RateDtoFactory() ;
            $rate_dto = $rate_factory->fromModel($rate) ;
        }
        else{
            $rate_dto = null ;
        }
        foreach ($users as $user){
            $factory = new UserBreakfastDtoFactory();
            $items[] = $factory->fromModel($user) ;
        }
        return  new BreakfastDto(
            $model->id ,
            $model->name ,
            $model->description ,
            $model->created_at ,
            $items,
            $model->avareageRate() ,
            $rate_dto
        );
    }



}
