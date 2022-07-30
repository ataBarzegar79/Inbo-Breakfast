<?php

namespace App\Services\Auth;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use function request;

class AuthServiceConcrete implements AuthService
{

    public function login(LoginRequest $request):bool
    {
        $user = User::where('name', '=', $request->name)
            ->where('password', '=', $request->password)
            ->first();
        if ($user) {
            Auth::login($user);
            $request->session()->regenerate();
            return true;
        }

        return false;

    }

    public function logout():void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}
