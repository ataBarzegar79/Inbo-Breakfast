<?php

namespace App\Services;

use App\Dtos\BreakfastDto;
use App\Dtos\UserBreakfastDto;
use App\Http\Requests\BreakfastUpdateRequest;
use App\Http\Requests\storeBreakfastRequest;

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
    public function create(): array;

    /**
     * @param int $breakfastId
     * @return array|boolean array => [UsersDto[] , BreakfastDto]
     */
    //fixme update documents according to functions
    //fixme use camelcase for function parameters
    public function edit(int $breakfastId): array|boolean;

    /**
     * @param storeBreakfastRequest $request
     */
    //fixme do not pass Request objects to service layer; ****
    public function store(storeBreakfastRequest $request): void;

    /**
     * @param BreakfastUpdateRequest $request
     * @param int $breakfastId
     * @return bool => true: update is complete  false: breakfast not found !
     */
    //fixme update documents according to functions
    //fixme use camelcase for function parameters
    public function update(BreakfastUpdateRequest $request, int $breakfastId):bool ;

    /**
     * @param int $breakfastId
     */
    //fixme use camelcase for function parameters :Done
    public function destroy(int $breakfastId): void;

}

