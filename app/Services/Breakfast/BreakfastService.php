<?php

namespace App\Services\Breakfast;

use App\Dtos\Breakfast\BreakfastDto;
use App\Dtos\Breakfast\BreakfastUpdateDto;
use App\Dtos\BreakfastStoreRequestDto;
use App\Dtos\BreakfastUpdateRequestDto;
use App\Dtos\UserBreakfastDto;
use App\Http\Requests\BreakfastUpdateRequest;
use App\Http\Requests\StoreBreakfastRequest;
use App\Models\Breakfast;
use App\Services\User\UserSupportService;
use phpDocumentor\Reflection\Types\Boolean;

//fixme start class names with uppercase letter :Done
//todo use consistent naming conventions through the application :Done
interface BreakfastService
{

    /**
     * @return BreakfastDto[]
     */
    public function index(): array;

    /**
     * @return UserBreakfastDTO[]
     */
    public function create(UserSupportService $userSupportService): array;

    /**
     * @param Breakfast $breakfast
     * @param UserSupportService $userSupportService
     * @return array|boolean array => [UsersDto[] , BreakfastDto]
     */
    //fixme update documents according to functions *done
    //fixme use camelcase for function parameters *done
    public function edit(Breakfast $breakfast, UserSupportService $userSupportService): array|boolean;

    /**
     * @param BreakfastStoreRequestDto $dto
     */
    //fixme do not pass Request objects to service layer; ****
    public function store(BreakfastStoreRequestDto $dto): void;

    /**
     * @param BreakfastUpdateRequestDto $dto
     * @param Breakfast $breakfast
     * @return bool => true: update is complete  false: breakfast not found !
     */
    //fixme update documents according to functions :Done
    //fixme use camelcase for function parameters :Done
    public function update(BreakfastUpdateRequestDto $dto, Breakfast $breakfast): bool;

    /**
     * @param Breakfast $breakfast
     */
    //fixme use camelcase for function parameters :Done
    public function destroy(Breakfast $breakfast): void;

}
