<?php

namespace App\Services;

use App\Dtos\UserDto;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use phpDocumentor\Reflection\Types\Void_;

interface UserService{

    /**
     * @return UserDto[]
     */
    public function index():array;


    /**
     * @param StoreUserRequest $request
     * @return void
     */
    public function store(StoreUserRequest $request):void;

    /**
     * @param int $id
     * @return UserDto[]
     */
    public function edit(int $id);

    /**
     * @param UpdateUserRequest $request
     * @param int $id
     * @return mixed
     */
    public function update(UpdateUserRequest $request, int $id);

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void;


    /**
     * @return UserDto[]
     */
    public function standing():array;

}
