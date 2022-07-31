<?php

namespace App\Services\Breakfast;

use App\Dtos\Breakfast\BreakfastDtoDoerFactory;
use App\Dtos\Breakfast\BreakfastDtoFactory;
use App\Dtos\Breakfast\BreakfastUpdateDtoFactory;
use App\Dtos\BreakfastStoreRequestDto;
use App\Dtos\BreakfastUpdateRequestDto;
use App\Dtos\Rate\RateDtoFactory;
use App\Dtos\UserBreakfastDtoFactory;
use App\Models\Breakfast;
use App\Models\User;
use App\Services\Support\JalaliService;
use App\Services\User\UserSupportService;
use JetBrains\PhpStorm\ArrayShape;
use phpDocumentor\Reflection\Types\Boolean;
use function auth;
use function resolve;


class  BreakfastCrudService implements BreakfastService
{


    public function index(): array
    {
        $user = auth()->user();
        $breakfasts = Breakfast::all();
        $breakfastDtos = [];
        foreach ($breakfasts as $breakfast) {
            $doers = [];
            $rates = $breakfast->rates;
            $users = $breakfast->users;
            $userRate = null;
            $persianService = resolve(JalaliService::class);
            $persianService = $persianService->toPersian($breakfast->created_at);
            $breakfastSupport = resolve(BreakfastSupportService::class);
            $breakfastAverage = $breakfastSupport->averageRate($breakfast);

            foreach ($users as $doer) {
                $doers[] = BreakfastDtoDoerFactory::fromModel($doer);

            }

            foreach ($rates as $rate) {
                if ($rate->user->id == $user->id) {
                    $userRate = RateDtoFactory::fromModel($rate);
                }
            }
            $breakfastDtos[] = BreakfastDtoFactory::fromModel($breakfast, $persianService, $breakfastAverage, $doers, $userRate);
        }

        return $breakfastDtos;
    }


    public function create(UserSupportService $userSupportService): array
    {
        $users = User::all();
        $usersDto = [];

        foreach ($users as $user) {
            $averAgeParticipating = $userSupportService->averAgeParticipating($user->id);
            $userDto = UserBreakfastDtoFactory::fromModel($user, $averAgeParticipating);
            $usersDtoAverage[] = [$userDto->average, $userDto];
        }

        sort($usersDtoAverage);

        foreach ($usersDtoAverage as $dto) {
            $usersDto[] = $dto[1];
        }

        return $usersDto;
    }


    //fixme define return type for functions : Done
    #[ArrayShape(['users' => "array", "breakfast" => "\App\Dtos\Breakfast\BreakfastUpdateDto"])]
    public function edit(Breakfast $breakfast, UserSupportService $userSupportService): array|boolean
    {
        $breakfastUsers = $breakfast->users;
        $doers = [];
        foreach ($breakfastUsers as $user) {
            $doers[] = BreakfastDtoDoerFactory::fromModel($user);
        }

        $breakfastDto = BreakfastUpdateDtoFactory::fromModel($breakfast, $doers);

        $users = User::all();
        $usersDto = [];

        foreach ($users as $user) {
            $usersDto[] = BreakfastDtoDoerFactory::fromModel($user);
        }

        return ['users' => $usersDto, "breakfast" => $breakfastDto];

    }

    public function store(BreakfastStoreRequestDto $dto): void
    {
        $service = resolve(JalaliService::class);
        $createdAt = $service->toAd($dto->date);

        $breakfast = Breakfast::create(
            [
                'name' => $dto->name,
                'description' => $dto->description,
                'created_at' => $createdAt,
            ]
        );

        $breakfast->users()->sync($dto->users);

    }


    public function update(BreakfastUpdateRequestDto $dto, Breakfast $breakfast): bool
    {
        $breakfast->name = $dto->name;
        $breakfast->description = $dto->description;
        $breakfast->save();

        $breakfast->users()->sync($dto->users);
        return true;

    }

    //fixme use camelcase for function parameters : Done
    public function destroy(Breakfast $breakfast): void
    {
        $breakfast->delete();
    }
}