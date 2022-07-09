<?php

namespace App\Http\Controllers;

use App\Models\Breakfast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function get($u_id,$b_id)
    {   $user = Auth::user();
        $breakfast = Breakfast::where('id','=',$b_id)->first() ;

         return view('vote' , ['breakfast'=>$breakfast,'user'=>$user]);
    }
}
