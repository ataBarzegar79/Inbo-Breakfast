<?php

namespace App\Services ;

use App\Http\Requests\LoginRequest;

interface AuthService{
    /**
     * @param LoginRequest $request
     * @return bool  true -> redirect to main page , false-> redirect back with error message
     */
    public function login(LoginRequest $request):bool;

    /**
     * @return void
     */
    public function logout():void;

}
