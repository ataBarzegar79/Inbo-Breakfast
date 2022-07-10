<?php

namespace App\Http\Controllers;

use App\Models\Breakfast;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create($breakfst_id)
    {
        $user = Auth::user();
        $breakfast = Breakfast::where('id',$breakfst_id)->first() ;
        return view('vote' , ['breakfast'=>$breakfast , 'user'=>$user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request , $breakfast_id)
    {
         $request->validate([
            'rate' => ['required', 'numeric' , 'between:1,10'],
            'description' => ['required', 'max:255'],
        ],[
            'rate.between' => 'your rate should be between 1 and 10 '
         ]);
         $user = Auth::user() ;
         $rate = Rate::create([
             'rate' =>$request->rate ,
             'description' =>$request->description ,
             'user_id'=> $user->id ,
             'breakfast_id' => $breakfast_id
         ]) ;

         return redirect()->route('dashboard');





    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
