<?php

namespace App\Controllers;

//use App\Http\Requests\BreakfastCreateRequest;
use App\Http\Requests\storeBreakfastRequest;
use App\Models\Breakfast;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;
use function redirect;
use function view;

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


    public function save(storeBreakfastRequest $request){


        $persian_date = explode("/" , $request->date) ;
        $created_at =(new Jalalian($persian_date[0], $persian_date[1], $persian_date[2], 0, 0, 0))->toCarbon()->toDateTimeString() ;

        $breakfast = Breakfast::create(
            [
                'name' => $request->name ,
                'description'=>$request->description ,
                'created_at' => $created_at ,
            ]
        );
        $breakfast->users()->sync($request->users) ;

        return redirect()->route('dashboard') ;


    }

    function destroy($id){
    $deleted_breakfast = Breakfast::where('id' , $id)->first();
    $deleted_breakfast->delete() ;
    return redirect()->route('dashboard') ;

  }


}
