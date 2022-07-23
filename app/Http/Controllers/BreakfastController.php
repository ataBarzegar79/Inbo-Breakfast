<?php

namespace App\Http\Controllers;

//use App\Http\Requests\BreakfastCreateRequest;
use App\Http\Requests\storeBreakfastRequest;
use App\Models\Breakfast;
use App\Models\User;
use App\Services\breakfastService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;
use function redirect;
use function view;

class BreakfastController extends Controller
{
    public function index(breakfastService $service)
    {
        return view('dashboard' ,  ['breakfasts'=>$service->index()]);
    }

    public function create(breakfastService $service)
    {

        return view('breakfast-create' , [ 'users'=>$service->create()]);
    }


    public function store(breakfastService $service , storeBreakfastRequest $request){
        $service->store($request);
        return redirect()->route('dashboard') ;
    }

    public function destroy($id , breakfastService $service)
    {
        $service->destroy($id);
        return redirect()->route('dashboard') ;
    }

   public function  update( $breakfast_id){
        if(!$breakfast = Breakfast::find($breakfast_id) ){
            return redirect()->route('dashboard') ;
        }

        $users = User::all();

        return view('breakfast-update' , ['breakfast'=>$breakfast , 'users'=>$users]) ;
   }


    public function edit(storeBreakfastRequest $request , $breakfast_id)
    {
        if(!$breakfast = Breakfast::find($breakfast_id) ) {
            return redirect()->route('dashboard');
        }
        $persian_date = explode("/" , $request->date) ;
        $created_at =(new Jalalian((int)$persian_date[0], (int)$persian_date[1], (int)$persian_date[2], 0, 0, 0))->toCarbon() ;

        $breakfast ->name = $request->name ;
        $breakfast->description = $request->description ;
        $breakfast->created_at = $created_at ;
        $breakfast->save() ;

        $breakfast->users()->sync($request->users) ;

        return redirect()->route('dashboard') ;

    }

}
