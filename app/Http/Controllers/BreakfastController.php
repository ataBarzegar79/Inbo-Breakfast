<?php

namespace App\Http\Controllers;

use App\Models\Breakfast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BreakfastController extends Controller
{
    public function show()
    {
        $user = Auth::user() ;

        $breakfasts = Breakfast::all() ;
        return view('dashboard' ,  ['breakfasts'=>$breakfasts,'user'=>$user]);

    }

    public function create()
    {
        $auth_user = Auth::user();
        return view('breakfast-create' , ['auth_user' => $auth_user]) ;
    }


}
