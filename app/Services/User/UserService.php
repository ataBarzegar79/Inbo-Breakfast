<?php

namespace App\Services\User;

use App\Dtos\Pagination\Pagination;
use App\Dtos\UserDto;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\Breakfast\BreakfastSupportService;

interface UserService
{
    /**
     * @param UserSupportService $service
     * @param BreakfastSupportService $breakfastSupportService
     * @return UserDto[]
     */
    public function index(BreakfastSupportService $breakfastSupportService): Pagination;

    /**
     * @param StoreUserRequest $request
     * @return void
     */
    public function store(StoreUserRequest $request): void;

    /**
     * @param int $id
     * @return UserDto|bool
     */
    public function edit(int $id): object|bool;

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
    public function standing(BreakfastSupportService $breakfastSupportService): array;

}
