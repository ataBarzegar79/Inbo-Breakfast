<?php

namespace App\Services;

use App\Dtos\BreakfastDtoDoerFactory;
use App\Dtos\BreakfastDtoFactory;
use App\Dtos\BreakfastRequestDto;
use App\Dtos\BreakfastRequestDtoFactory;
use App\Dtos\BreakfastUpdateDtoFactory;
use App\Dtos\RateDtoFactory;
use App\Dtos\UserBreakfastDtoFactory;
use App\Http\Requests\BreakfastUpdateRequest;
use App\Http\Requests\StoreBreakfastRequest;
use App\Models\Breakfast;
use App\Models\User;
use App\Services\Support\JalaliService;
use phpDocumentor\Reflection\Types\Boolean;


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
    public function edit(int $breakfastId, UserSupportService $userSupportService): array|boolean
    {
        $breakfast = Breakfast::find($breakfastId);
        if (!$breakfast) {
            return false;
        }
        $breakfastUsers = $breakfast->users;
        $doers = [] ;
        foreach ($breakfastUsers as $user) {
            $doers[] = BreakfastDtoDoerFactory::fromModel($user) ;
        }

        $breakfastDto = BreakfastUpdateDtoFactory::fromModel($breakfast,$doers);

        $users = User::all();
        $usersDto = [];

        foreach ($users as $user) {
            $usersDto[] = BreakfastDtoDoerFactory::fromModel($user) ;
        }

        return ['users' => $usersDto, "breakfast" => $breakfastDto];

    }

    public function store(BreakfastRequestDto $request): void
    // todo public function store(BreakfastRequestDto $request): void
    {
        $requestData = BreakfastRequestDtoFactory::fromRequest($request);
        $service = resolve(JalaliService::class);
        $createdAt = $service->toAd($requestData->date);

        $breakfast = Breakfast::create(
            [
                'name' => $requestData->name,
                'description' => $requestData->description,
                'created_at' => $createdAt,
            ]
        );

        $breakfast->users()->sync($requestData->users);

    }


    public function update(BreakfastRequestDto $request, int $breakfastId): bool
    {
        $requestData = BreakfastRequestDtoFactory::fromRequest($request);
        $breakfast = Breakfast::find($breakfastId);
        if (!$breakfast) {
            return false;
        }

        $breakfast->name = $requestData->name;
        $breakfast->description = $requestData->description;
        $breakfast->save();

        $breakfast->users()->sync($requestData->users);
        return true;

    }

    //fixme use camelcase for function parameters : Done
    public function destroy(int $breakfastId): void
    {
        $deletedBreakfast = Breakfast::find($breakfastId);//fixme use camelcase for variable names : Done
        $deletedBreakfast->delete();
    }
}
