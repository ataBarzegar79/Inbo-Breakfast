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
     * @return UserDto|bool
     */
    public function edit(int $id):object|bool;

    /**
     * @param UpdateUserRequest $request
     * @param int $id
     * @return void
     */

    public function update(updateUserRequest $request, int $id):void;


    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void;


    /**
     * @return array [[float average ,UserDto userdto],[float average , userdto],.....]
     */
    public function standing():array;

}
