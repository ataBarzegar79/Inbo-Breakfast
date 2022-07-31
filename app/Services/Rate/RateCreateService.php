<?php

namespace App\Services\Rate;

use App\Dtos\Breakfast\BreakfastDtoDoerFactory;
use App\Dtos\Breakfast\BreakfastUpdateDto;
use App\Dtos\Breakfast\BreakfastUpdateDtoFactory;
use App\Dtos\VoteRequestDto;
use App\Models\Breakfast;
use App\Models\Rate;
use function auth;

class  RateCreateService implements RateService
{

    //fixme use camelcase for function parameters :Done
    public function create(Breakfast $breakfsatvote): BreakfastUpdateDto
    {
        $breakfastUsers = $breakfsatvote->users;
        foreach ($breakfastUsers as $user) {
            $doers[] = BreakfastDtoDoerFactory::fromModel($user);
        }
        return BreakfastUpdateDtoFactory::fromModel($breakfsatvote, $doers);
    }

    //fixme use camelcase for function parameters : Done
    public function store(VoteRequestDto $dto, Breakfast $breakfsatvote): void
    {
        $user = auth()->user();
        Rate::create([ //todo clean unused variables :Done
            'user_id' => $user->id, // todo Ehsan: change this to Auth::id()
            'rate' => $dto->rate,
            'description' => $dto->description,
            'breakfast_id' => $breakfsatvote->id,
        ]);
    }

}
