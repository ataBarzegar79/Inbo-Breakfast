<?php

namespace App\Http\Controllers;

use App\Models\Breakfast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user() ;

        $breakfasts = Breakfast::all() ;
        return view('dashboard' ,  ['breakfasts'=>$breakfasts,'user'=>$user]);

    }
}
