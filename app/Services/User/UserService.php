<?php

namespace App\Services\User;

use App\Dtos\UserDto;
use App\Dtos\UserRequestDto;
use App\Models\User;
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
     * @param User $user
     * @return UserDto|bool
     */
    public function edit(User $user): object|bool;

    /**
     * @param UserRequestDto $dto
     * @param User $user
     * @return void
     */
    public function update(UserRequestDto $dto, User $user): void;

    /**
     * @param User $user
     * @return void
     */
    public function destroy(User $user): void;

}
