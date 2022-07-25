<?php

namespace App\Http\Controllers;

//use App\Http\Requests\BreakfastCreateRequest;
use App\Http\Requests\BreakfastUpdateRequest;
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

    public function  edit( $breakfast_id , breakfastService $service  ){

        $edited_breakfast = $service->edit($breakfast_id) ;
        return view('breakfast-update' , ['breakfast'=>$edited_breakfast["breakfast"] , 'users'=>$edited_breakfast['users'] ]) ;
    }


    public function update(BreakfastUpdateRequest $request , $breakfast_id , breakfastService $service)
    {
        $service ->update($request , $breakfast_id ) ;
        return redirect()->route('dashboard') ;


    }

}
