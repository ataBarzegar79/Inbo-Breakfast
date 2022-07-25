<?php

namespace App\Services ;

use App\Dtos\BreakfastDto;
use App\Dtos\BreakfastDtoFactory;
use App\Http\Requests\storeVoteRequest;
use App\Models\Breakfast;
use App\Models\Rate;


class  RateCreateService implements RateService{

    public function create(int $breakfast_id): BreakfastDto
    {

        $breakfast = Breakfast::find($breakfast_id) ;
        $breakfast_factory = new BreakfastDtoFactory() ;
        $breakfast_dto = $breakfast_factory->fromModel($breakfast ,null)  ;
        return $breakfast_dto ;
    }


    public function store(storeVoteRequest $request, int $breakfast_id): void
    {
        $user = auth()->user();
        $rate = Rate::create([
            'rate' => $request->rate,
            'description' => $request->description,
            'user_id' => $user->id,
            'breakfast_id' => $breakfast_id
        ]);
    }

}
