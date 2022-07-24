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
        $service->store($request);
        return  redirect()->route('users.index');
    }


    public function edit(int $id, UserService $service)
    {

       $update_user = $service->edit($id);
       return view('update-user' , ['update_user'=>$update_user ]) ;

    }


    public function update(UserService $service, updateUserRequest $request, int $id)
    {
        $service->update($request , $id ) ;
        return  redirect()->route('users.index') ;
    }


    public function destroy($id, UserService $service)
    {
        $service->destroy($id);
        return redirect()->route('users.index');
    }

    public function standings(UserService $service)
    {
/*        $users = User::all() ;
        $list = [];
        foreach ($users as $user){
            $list[] = [$user->averAgeParticipating(), $user  ];
        }
        rsort($list);*/
        return view('standings' ,['users' => $service->standing() ]  ) ;
    }
}
