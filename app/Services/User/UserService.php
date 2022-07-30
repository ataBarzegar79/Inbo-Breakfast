<?php

namespace App\Services\User;

use App\Dtos\UserDto;
use App\Dtos\UserRequestDto;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\Breakfast\BreakfastSupportService;

interface UserService
{
    /**
     * @param BreakfastSupportService $breakfastSupportService
     * @return UserDto[]
     */
    public function index(BreakfastSupportService $breakfastSupportService): array;

    /**
     * @param UserRequestDto $dto
     * @return void
     */
    public function store(UserRequestDto $dto): void;

    /**
     * @param int $id
     * @return UserDto|bool
     */
    public function edit(int $id): object|bool;

    /**
     * @param UserRequestDto $dto
     * @param int $id
     * @return void
     */
    public function update(UserRequestDto $dto, int $id): void;

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void;


    /**
     * @param BreakfastSupportService $breakfastSupportService
     * @return array [[float average ,UserDto userdto],[float average , userdto],.....]
     */
    public function standing(BreakfastSupportService $breakfastSupportService): array;

}
