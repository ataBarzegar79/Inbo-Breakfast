<?php

namespace App\Services\User;

use App\Dtos\Pagination\Pagination;
use App\Dtos\Request\UserRequestDto;
use App\Dtos\User\UserDto;
use App\Models\User;

interface UserCrudService
{
    /**
     * @return Pagination
     */
    public function index(): Pagination;

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


    /**
     * @return array [[float average ,UserDto userdto],[float average , userdto],.....]
     */
    public function standing(): array;

}
