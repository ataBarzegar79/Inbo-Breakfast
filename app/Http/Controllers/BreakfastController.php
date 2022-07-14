<?php

namespace App\Http\Controllers;

use App\Models\Breakfast;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BreakfastController extends Controller
{
    public function show()
    {
        $authUser = Auth::user() ;

        $breakfasts = Breakfast::all() ;
        return view('dashboard' ,  ['breakfasts'=>$breakfasts]);

    }

    public function create()
    {
        $authUser = Auth::user();
        $users = User::all() ;
        return view('breakfast-create' , [ 'users'=>$users]);
    }


    public function save(Request $request){
//        return var_dump($request->date) ;
        $all_users = User::all() ;
        $all_users_id = [] ;
        foreach ($all_users as $user){
            $all_users_id[] = (string)$user->id ;
        }

        $request->validate([
            'name'=>['required' , 'max:255' ] ,
            'description'=>['max:255'] ,
            'date' => ['date'] ,
            'user' =>['required' ,'in:'.implode(',' ,$all_users_id) ]
        ] , [ 'user.in' => 'please choose a Valid user!']);
        $persian_set_format = explode("/" , $request->date) ;
        Breakfast::create(
            [
                'name' => $request->name ,
                'description'=>$request->description ,
                'created_at' => $persian_set_format ,
                'user_id' => (int)$request->user ,
            ]
        );

        return redirect()->route('dashboard') ;


    }

    function destroy($id){
    $deleted_breakfast = Breakfast::where('id' , $id)->first();
    $deleted_breakfast->delete() ;
    return redirect()->route('dashboard') ;

  }


}
