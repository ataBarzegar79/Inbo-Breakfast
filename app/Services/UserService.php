<?php

namespace App\Services;

use App\Dtos\UserDto;
use App\Http\Requests\storeUserRequest;
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

}
