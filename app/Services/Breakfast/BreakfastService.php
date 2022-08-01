<?php

namespace App\Services\Breakfast;

use App\Dtos\BreakfastStoreRequestDto;
use App\Dtos\BreakfastUpdateRequestDto;
use App\Dtos\Pagination\Pagination;
use App\Dtos\UserBreakfastDto;
use App\Models\Breakfast;
use App\Services\User\UserSupportService;
use phpDocumentor\Reflection\Types\Boolean;

interface BreakfastService
{
    /**
     * @return Pagination
     */
    public function index(): Pagination;

    /**
     * @return UserBreakfastDTO[]
     */
    public function create(UserSupportService $userSupportService): array;

    /**
     * @param Breakfast $breakfast
     * @param UserSupportService $userSupportService
     * @return array|boolean array => [UsersDto[] , BreakfastDto]
     */
    public function edit(Breakfast $breakfast, UserSupportService $userSupportService): array|boolean;

    /**
     * @param BreakfastStoreRequestDto $dto
     */
    public function store(BreakfastStoreRequestDto $dto): void;

    /**
     * @param BreakfastUpdateRequestDto $dto
     * @param Breakfast $breakfast
     * @return bool => true: update is complete  false: breakfast not found !
     */
    public function update(BreakfastUpdateRequestDto $dto, Breakfast $breakfast): bool;

    /**
     * @param Breakfast $breakfast
     */
    public function destroy(Breakfast $breakfast): void;

}
