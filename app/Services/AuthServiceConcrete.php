<?php

namespace App\Services ;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthServiceConcrete implements AuthService {

    public function login()
    {
        $user = User::where('name', '=', $request->get('name'))
            ->where('password', '=', $request->get('password'))
            ->first();
        if ($user) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('dashboard'); //fixme use route method for paths *done
        }

        return back()->withErrors([
            'notfound' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        // TODO: Implement logout() method.
    }
}
