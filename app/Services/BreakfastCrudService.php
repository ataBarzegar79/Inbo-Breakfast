<?php

namespace App\Services;

use App\Dtos\BreakfastDtoDoerFactory;
use App\Dtos\BreakfastDtoFactory;
use App\Dtos\RateDtoFactory;
use App\Dtos\UserBreakfastDtoFactory;
use App\Http\Requests\BreakfastUpdateRequest;
use App\Http\Requests\StoreBreakfastRequest;
use App\Models\Breakfast;
use App\Models\User;
use App\Services\Support\JalaliService;
use Morilog\Jalali\Jalalian;
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
            $userRate = null ;
            $persianService = resolve(JalaliService::class);
            $persianService = $persianService->toPersian($breakfast->created_at);
            $breakfastSupport = resolve(BreakfastSupportService::class);
            $breakfastAverage = $breakfastSupport->averageRate($breakfast);

            foreach ($users as $doer) {
                $doers[] = BreakfastDtoDoerFactory::fromModel($doer);

            }

            foreach ($rates as $rate) {
                if ($rate->user->id == $user->id) {
                    $userRate =  RateDtoFactory::fromModel($rate);
                }
            }
            $breakfastDtos[] = BreakfastDtoFactory::fromModel($breakfast, $persianService, $breakfastAverage, $doers,$userRate);
        }

        return $breakfastDtos;
    }


    public function create(UserSupportService $userSupportService): array
    {
        //fixme use camelcase for variable names :Done
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

        $breakfast = Breakfast::find($breakfastId);
        $breakfastDto = BreakfastDtoFactory::fromModel($breakfast, null, $userSupportService);

        $users = User::all();
        $usersDto = [];

        foreach ($users as $user) {
            $averAgeParticipating = $userSupportService->averAgeParticipating($user->id);
            $newUserDto = UserBreakfastDtoFactory::fromModel($user, $averAgeParticipating);
            $usersDto[] = $newUserDto;
        }

        return ['users' => $usersDto, "breakfast" => $breakfastDto];

    }

    public function store(StoreBreakfastRequest $request): void
    {
        $service = resolve(JalaliService::class);
        $createdAt = $service->toAd($request->date);

        $breakfast = Breakfast::create(
            [
                'name' => $request->name,
                'description' => $request->description,
                'created_at' => $createdAt,
            ]
        );

        $breakfast->users()->sync($request->users);

    }

    //fixme define return type for functions :Done
    //fixme use camelcase for function parameters : Done
    public function update(BreakfastUpdateRequest $request, int $breakfastId): bool
    {
        $breakfast = Breakfast::find($breakfastId);
        if (!$breakfast) {
            //fixme use camelcase for variable names : Done
            return false;//fixme redirect !!!! : Done
        }

        $breakfast->name = $request->name;
        $breakfast->description = $request->description;
        $breakfast->save();

        $breakfast->users()->sync($request->users);
        return true;

    }

    //fixme use camelcase for function parameters : Done
    public function destroy(int $breakfastId): void
    {
        $deletedBreakfast = Breakfast::find($breakfastId);//fixme use camelcase for variable names : Done
        $deletedBreakfast->delete();
    }
}
