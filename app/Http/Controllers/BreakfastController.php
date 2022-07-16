<?php

namespace App\Http\Controllers;

//use App\Http\Requests\BreakfastCreateRequest;
use App\Models\Breakfast;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;

class BreakfastController extends Controller
{
    public function show()
    {
        $authUser = Auth::user() ;

        $breakfasts = Breakfast::all() ;
        foreach ($breakfasts as $breakfast){

            $breakfast->persian = Jalalian::fromCarbon(new Carbon($breakfast->created_at))->format('%A, %d %B %Y');

        }
        return view('dashboard' ,  ['breakfasts'=>$breakfasts]);

    }

    public function create()
    {
        $authUser = Auth::user();
        $users = User::all() ;
        return view('breakfast-create' , [ 'users'=>$users]);
    }


    public function save(Request $request){

        $all_users = User::all() ;
        $all_users_id = [] ;
        foreach ($all_users as $user){
            $all_users_id[] = (string)$user->id ;
        }

        $request->validate([
            'name'=>['required' , 'max:255' ] ,
            'description'=>['max:255'] ,
            'user' =>['required' ,'in:'.implode(',' ,$all_users_id) ]
        ] , [ 'user.in' => 'please choose a Valid user!']);
        $persian_date = explode("/" , $request->date) ;
        $created_at =(new Jalalian($persian_date[0], $persian_date[1], $persian_date[2], 0, 0, 0))->toCarbon()->toDateTimeString() ;
        Breakfast::create(
            [
                'name' => $request->name ,
                'description'=>$request->description ,
                'created_at' => $created_at ,
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
