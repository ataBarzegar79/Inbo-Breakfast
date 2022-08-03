<?php

namespace App\Services\Breakfast;

use App\Dtos\BreakfastUser\UserBreakfastDto;
use App\Dtos\Pagination\Pagination;
use App\Dtos\Request\BreakfastStoreRequestDto;
use App\Dtos\Request\BreakfastUpdateRequestDto;
use App\Models\Breakfast;
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
    public function create(): array;

    /**
     * @param Breakfast $breakfast
     * @return array|boolean array => [UsersDto[] , BreakfastDto]
     */
    public function edit(Breakfast $breakfast): array|boolean;

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
