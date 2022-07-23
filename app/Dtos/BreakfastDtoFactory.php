<?php

namespace App\Dtos;

use App\Models\Breakfast;


class BreakfastDtoFactory
{
    public function fromModel(Breakfast $model): BreakfastDto
    {
        return  new BreakfastDto(
            $model->id ,
            $model->name ,
            $model->description ,
            $model->created_at ,
            $model->users ,
            $model->avareageRate()  );
    }



}
