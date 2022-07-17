<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function back;
use function redirect;
use function view;

class AuthController extends Controller
{
    public function show(){
            return view('login') ;
    }

    public function login(loginRequest $request){

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


     public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


}
