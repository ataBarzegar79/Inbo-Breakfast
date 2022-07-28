<?php

namespace App\Services;

use App\Dtos\UserDto;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

interface UserService
{
    /**
     * @param UserSupportService $service
     * @param BreakfastSupportService $breakfastSupportService
     * @return UserDto[]
     */
    public function index(UserSupportService $service, BreakfastSupportService $breakfastSupportService): array;

    /**
     * @param StoreUserRequest $request
     * @return void
     */
    public function store(StoreUserRequest $request): void;

    /**
     * @param int $id
     * @param UserSupportService $service
     * @return UserDto|bool
     */
    public function edit(int $id, UserSupportService $service): object|bool;

    /**
     * @param UpdateUserRequest $request
     * @param int $id
     * @return void
     */
    public function update(UpdateUserRequest $request, int $id): void;

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void;


    /**
     * @param UserSupportService $service
     * @return array [[float average ,UserDto userdto],[float average , userdto],.....]
     */
    public function standing(UserSupportService $service, BreakfastSupportService $breakfastSupportService): array;

}
