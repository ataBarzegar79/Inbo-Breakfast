<?php

namespace App\Services;

use App\Dtos\UserDto;

interface UserService{

    /**
     * @return UserDto[]
     */
    public function index();

}
