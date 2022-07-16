<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;




class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */

    public function index()
    {
        $authUser = Auth::user();
        $users = User::all();
        return view('users', [ 'users' => $users]);
    }

//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email:rfc', 'unique:users,email'],
            'password' => ['required'],
            'avatar' => ['file', 'image', 'max:512'],
            'is_admin' => ['required', 'in:yes,no']
        ]);

        if($request->avatar !== null) {
            $avatar_extension = '.' . $request->avatar->extension();
            $email_path = $request->email;
            $avatar_path = $email_path.$avatar_extension ;
            $Avatar_saving = $request->file('avatar')->storeAs(
                'avatars', $avatar_path, 'public'
            );
        }
        else{
            $avatar_path = "default.svg" ;
        }

        $new_user = User::create([
            'name' => $request ->name ,
            'email' => $request ->email ,
            'password' => $request -> password ,
            'avatar' => 'avatars\\'.$avatar_path ,
            'is_admin' => $request->is_admin
        ]);

        return  redirect()->route('users.index');


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return mixed
     */
    public function edit($id)
    {


       $update_user = User::where('id',$id)->first() ;
       return view('update-user' , ['update_user'=>$update_user ]) ;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email:rfc'],
            'password' => ['required'],
            'avatar' => ['file', 'image', 'max:512'],
            'is_admin' => ['required', 'in:yes,no']
        ]);

        if($request->avatar !== null) {
            $avatar_extension = '.' . $request->avatar->extension();
            $email_path = $request->email;
            $avatar_path = $email_path.$avatar_extension ;
            $Avatar_saving = $request->file('avatar')->storeAs(
                'avatars', $avatar_path, 'public'
            );
        }
        else{
            $avatar_path = "default.svg" ;
        }

        $updated_user = User::find($id) ;
        $updated_user->name = $request->name ;
        $updated_user->email = $request->email;
        $updated_user->is_admin = $request->is_admin ;
        $updated_user ->avatar = 'avatars\\'.$avatar_path  ;
        $updated_user->save() ;

        return  redirect()->route('users.index') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return mixed
     */
    public function destroy($id)
    {
        $deleted_item = User::find($id) ;
        $deleted_item->delete() ;

        return redirect()->route('users.index');
    }

    public function standings()
    {
        $authUser = Auth::user() ;
        $users = User::all() ;
        return view('standings' ,['user'=>$users ]  ) ;
    }
}
