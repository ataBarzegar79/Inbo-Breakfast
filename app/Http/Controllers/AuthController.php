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
    //fixme define return type for functions
    public function show(){
            return view('login') ; //fixme: pay attention to indentations
    }

    //fixme define return type for functions
    public function login(loginRequest $request){
        //fixme format functions brackets '{' consistently
        //todo replace inline namespaces with imports
        $user = \App\Models\User::where('name','=',$request->get('name'))
            ->where('password','=',$request->get('password'))
            ->first();
        if($user){
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('') ; //fixme use route method for paths
        }

        return back()->withErrors([
            'notfound' => 'The provided credentials do not match our records.',
        ]);
     }

    //fixme define return type for functions
     public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');//fixme use route method for paths
    }


}
