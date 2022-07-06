<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLoginPage(){
            return view('login') ;
    }

    public function getAuthData(Request $request){
        $credentials = $request->validate([
            'name' => ['required', 'max:255'],
            'password' => ['required'],
        ]);

        $user = \App\Models\User::where('name','=',$request->get('name'))
            ->where('password','=',$request->get('password'))
            ->first();
        if($user){
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('') ;
        }

        return back()->withErrors([
            'notfound' => 'The provided credentials do not match our records.',
        ]);
     }



}
