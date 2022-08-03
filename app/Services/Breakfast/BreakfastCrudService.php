<?php

namespace App\Services\Breakfast;

use App\Dtos\Breakfast\BreakfastDtoDoerFactory;
use App\Dtos\Breakfast\BreakfastDtoFactory;
use App\Dtos\Breakfast\BreakfastUpdateDtoFactory;
use App\Dtos\BreakfastUser\UserBreakfastDtoFactory;
use App\Dtos\Pagination\BreakfastPaginationDto;
use App\Dtos\Pagination\Pagination;
use App\Dtos\Rate\RateDtoFactory;
use App\Dtos\Request\BreakfastStoreRequestDto;
use App\Dtos\Request\BreakfastUpdateRequestDto;
use App\Models\Breakfast;
use App\Models\Rating;
use App\Models\User;
use App\Services\Support\JalaliService;
use App\Services\User\UserParticipatingPerTimeService;
use JetBrains\PhpStorm\ArrayShape;
use phpDocumentor\Reflection\Types\Boolean;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use function auth;
use function resolve;


class  BreakfastCrudService implements BreakfastService
{


    /**
     * @throws UnknownProperties
     */
    public function index(): Pagination
    {

        $user = auth()->user();
        $breakfasts = Breakfast::ordering()->paginate(3); // scope using
        $breakfastDtos = [];
        foreach ($breakfasts as $breakfast) {
            $doers = [];
            $userRate = null;
            $rate = Rating::findByUser($user->id)->findByBreakfast($breakfast->id)->first(); //scope using
            if ($rate) {
                $userRate = RateDtoFactory::fromModel($rate);
            }

            $persianService = resolve(JalaliService::class);
            $persianService = $persianService->toPersian($breakfast->created_at);

            $breakfastSupport = resolve(BreakfastAverageRateService::class);
            $breakfastAverage = $breakfastSupport->averageRate($breakfast);

            $breakfastDoers = $breakfast->users;
            foreach ($breakfastDoers as $doer) {
                $doers[] = BreakfastDtoDoerFactory::fromModel($doer);
            }

            $breakfastDtos[] = BreakfastDtoFactory::fromModel(
                $breakfast,
                $persianService,
                $breakfastAverage,
                $doers,
                $userRate
            );
        }
        return BreakfastPaginationDto::fromModelPaginatorAndData($breakfasts, $breakfastDtos);
    }


    public function create(): array
    {
        $users = User::all();

        $userParticipatingPerTimeService = resolve(UserParticipatingPerTimeService::class);


        foreach ($users as $user) {
            $averAgeParticipating = $userParticipatingPerTimeService->userParticipatingPerTime($user);
            $userDto = UserBreakfastDtoFactory::fromModel($user, $averAgeParticipating);
            $usersDtoAverage[] = [$userDto->average, $userDto];
        }

        sort($usersDtoAverage);

        foreach ($usersDtoAverage as $dto) {
            $usersDto[] = $dto[1];
        }

        return $usersDto;
    }

    #[ArrayShape(['users' => "array", "breakfast" => "\App\Dtos\Breakfast\BreakfastUpdateDto"])]
    public function edit(Breakfast $breakfast): array|boolean
    {
        $breakfastUsers = $breakfast->users;
        $doers = [];
        foreach ($breakfastUsers as $user) {
            $doers[] = BreakfastDtoDoerFactory::fromModel($user);
        }

        $breakfastDto = BreakfastUpdateDtoFactory::fromModel($breakfast, $doers);

        $users = User::select('id', 'name')->get();
        foreach ($users as $user) {
            $usersDto[] = BreakfastDtoDoerFactory::fromModel($user);
        }

        return ['users' => $usersDto, "breakfast" => $breakfastDto];

    }

    public function store(BreakfastStoreRequestDto $dto): void
    {
        $service = resolve(JalaliService::class);
        $createdAt = $service->toAdFormat($dto->date);

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

    public function destroy(Breakfast $breakfast): void
    {
        $breakfast->delete();
    }
}
