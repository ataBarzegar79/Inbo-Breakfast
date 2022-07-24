<?php

namespace App\Services;

use App\Dtos\UserDto;
use App\Http\Requests\storeUserRequest;
use App\Http\Requests\updateUserRequest;
use phpDocumentor\Reflection\Types\Void_;

interface UserService{

    /**
     * @return UserDto[]
     */
    public function index():array;


    /**
     * @param storeUserRequest $request
     * @return void
     */
    public function store(storeUserRequest $request):void;


    /**
     * @param updateUserRequest $request
     * @param int $id
     * @return mixed
     */
    public function update(updateUserRequest $request, int $id);

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
