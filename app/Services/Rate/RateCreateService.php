<?php

namespace App\Services\Rate;

use App\Dtos\Breakfast\BreakfastDtoDoerFactory;
use App\Dtos\Breakfast\BreakfastUpdateDto;
use App\Dtos\Breakfast\BreakfastUpdateDtoFactory;
use App\Dtos\VoteRequestDto;
use App\Models\Breakfast;
use App\Models\Rate;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\Pure;

class  RateCreateService implements RateService
{
    #[Pure] public function create(Breakfast $breakfsatvote): BreakfastUpdateDto
    {
        $breakfastUsers = $breakfsatvote->users;
        foreach ($breakfastUsers as $user) {
            $doers[] = BreakfastDtoDoerFactory::fromModel($user);
        }
        return BreakfastUpdateDtoFactory::fromModel($breakfsatvote, $doers);
    }

    public function store(VoteRequestDto $dto, Breakfast $breakfsatvote): void
    {
        Rate::create([
            'user_id' => Auth::id(),
            'rate' => $dto->rate,
            'description' => $dto->description,
            'breakfast_id' => $breakfsatvote->id,
        ]);
    }

}
