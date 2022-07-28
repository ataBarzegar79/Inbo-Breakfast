<?php

namespace App\Services;

use App\Dtos\BreakfastDto;
use App\Dtos\UserBreakfastDto;
use App\Http\Requests\BreakfastUpdateRequest;
use App\Http\Requests\StoreBreakfastRequest;

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
     * @param int $breakfastId
     * @return array|boolean array => [UsersDto[] , BreakfastDto]
     */
    //fixme update documents according to functions *done
    //fixme use camelcase for function parameters *done
    public function edit(int $breakfastId, UserSupportService $userSupportService): array|boolean;

    /**
     * @param StoreBreakfastRequest $request
     */
    //fixme do not pass Request objects to service layer; ****
    public function store(StoreBreakfastRequest $request): void;

    /**
     * @param BreakfastUpdateRequest $request
     * @param int $breakfastId
     * @return bool => true: update is complete  false: breakfast not found !
     */
    //fixme update documents according to functions :Done
    //fixme use camelcase for function parameters :Done
    public function update(BreakfastUpdateRequest $request, int $breakfastId):bool ;

    /**
     * @param int $breakfastId
     */
    //fixme use camelcase for function parameters :Done
    public function destroy(int $breakfastId): void;

}
