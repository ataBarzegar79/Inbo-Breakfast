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
     * @param $id
     * @return mixed
     */
    public function update(updateUserRequest $request, int $id);

}
