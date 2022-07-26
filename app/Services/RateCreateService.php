<?php

namespace App\Services;

use App\Dtos\BreakfastDto;
use App\Dtos\BreakfastDtoFactory;
use App\Http\Requests\StoreVoteRequest;
use App\Models\Breakfast;
use App\Models\Rate;


class  RateCreateService implements RateService
{

    //fixme use camelcase for function parameters :Done
    public function create(int $breakfastId): BreakfastDto
    {
        $breakfast = Breakfast::find($breakfastId);
        $breakfastFactory = new BreakfastDtoFactory();//fixme use camelcase for variable names :Done
        return $breakfastFactory->fromModel($breakfast, null);
    }


    //fixme use camelcase for function parameters : Done
    public function store(storeVoteRequest $request, int $breakfastId): void
    {
        $user = auth()->user();
        Rate::create([ //todo clean unused variables :Done
            'user_id' => $user->id,
            'rate' => $request->rate,
            'description' => $request->description,
            'breakfast_id' => $breakfastId
        ]);
    }

}
