<?php

namespace App\Services;


use App\Dtos\BreakfastDtoFactory;
use App\Dtos\UserBreakfastDtoFactory;
use App\Http\Requests\BreakfastUpdateRequest;
use App\Http\Requests\storeBreakfastRequest;
use App\Models\Breakfast;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Morilog\Jalali\Jalalian;
use phpDocumentor\Reflection\Types\Boolean;

//fixme cleanup unused imports : Done

//fixme fix misspells :Done
class  BreakfastCrudService implements breakfastService
{


    public function index(): array
    {
        $user = auth()->user();
        $breakfasts = Breakfast::all();
        $breakfastDtos = [];//fixme use camelcase for variable names : Done
        foreach ($breakfasts as $breakfast) {
            $rates = $breakfast->rates;
            $flag = 0;

            foreach ($rates as $rate) {
                if ($rate->user->id == $user->id) {
                    $user_rate = $rate;
                    $flag = 1;
                }
            }

            if ($flag == 0) {
                $user_rate = null;
            }

            $breakfast_factory = new BreakfastDtoFactory();
            $breakfastDtos[] = $breakfast_factory->fromModel($breakfast, $user_rate);
        }

        return $breakfastDtos;
    }


    public function create(): array
    {
        //fixme use camelcase for variable names :Done
        $users = User::all();
        $usersDto = [];

        foreach ($users as $user) {
            $factory = new UserBreakfastDtoFactory($user);
            $userDto = $factory->fromModel($user);
            $usersDtoAverage[] = [$userDto->average, $userDto];
        }

        sort($usersDtoAverage);

        foreach ($usersDtoAverage as $dto) {
            $usersDto[] = $dto;
        }

        return $usersDto;
    }


    //fixme define return type for functions : Done
    public function edit(int $breakfastId): array|boolean
    {
        $breakfast = Breakfast::find($breakfastId);
        if (!$breakfast) {
            return false;
        }

        $breakfast = Breakfast::find($breakfastId);
        $newBreakfastFactory = new BreakfastDtoFactory();//fixme use camelcase for variable names : Done
        $breakfastDto = $newBreakfastFactory->fromModel($breakfast, null);

        $users = User::all();
        $usersDto = [];
        $newUserFactory = new UserBreakfastDtoFactory();

        foreach ($users as $user) {
            $newUserDto = $newUserFactory->fromModel($user);
            $usersDto[] = $newUserDto;
        }

        return ['users' => $usersDto, "breakfast" => $breakfastDto];

    }

    public function store(storeBreakfastRequest $request): void
    {
        $persianDate = explode("/", $request->date);//todo use Jalaian format service to format Jalali strings
        $createdAt = (new Jalalian((int)$persianDate[0], (int)$persianDate[1], (int)$persianDate[2], 0, 0, 0))->toCarbon();

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
