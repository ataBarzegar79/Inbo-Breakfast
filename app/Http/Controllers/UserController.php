<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeUserRequest;
use App\Http\Requests\updateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use function redirect;
use function view;


class UserController extends Controller
{

    public function index(UserService $service)
    {
        return view('users', ['users' => $service->index()]);
    }
//    public function index()
//    {
//        $users = User::all();
//        return view('users', [ 'users' => $users]);
//    }


    public function store(UserService $service, storeUserRequest $request)
    {
/*        if($request->avatar !== null) {
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
        ]);*/
        $service->store($request);
        return  redirect()->route('users.index');


    }


    public function edit($id)
    {


       $update_user = User::where('id',$id)->first() ;
       return view('update-user' , ['update_user'=>$update_user ]) ;

    }


    public function update(updateUserRequest $request, $id)
    {

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


    public function destroy($id)
    {
        $deleted_item = User::find($id) ;
        $deleted_item->delete() ;

        return redirect()->route('users.index');
    }

    public function standings()
    {
        $users = User::all() ;
        $list = [];
        foreach ($users as $user){
            $list[] = [$user->averAgeParticipating(), $user  ];
        }
        rsort($list);

        return view('standings' ,['users'=>$list ]  ) ;
    }
}
