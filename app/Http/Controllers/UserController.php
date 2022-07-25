<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeUserRequest;
use App\Http\Requests\updateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use function redirect;
use function view;//fixme cleanup unused imports


class UserController extends Controller
{

    //fixme define return type for functions
    public function index(UserService $service)
    {
        return view('users', ['users' => $service->index()]);
    }
//    public function index()
//    {
//        $users = User::all();
//        return view('users', [ 'users' => $users]);
//    }

    //fixme define return type for functions
    public function store(UserService $service, storeUserRequest $request)
    {
        $service->store($request);
        return  redirect()->route('dashboard');
    }

    //fixme define return type for functions
    public function edit(int $id, UserService $service)
    {

       $update_user = $service->edit($id);//fixme use camelcase for variable names
       return view('update-user' , ['update_user'=>$update_user ]) ;

    }

    //fixme define return type for functions
    public function update(UserService $service, updateUserRequest $request, int $id)
    {
        $service->update($request , $id ) ;
        return  redirect()->route('dashboard') ;//fixme use route method for paths
        //todo use consistent spacings
    }

    //fixme define return type for functions
    public function destroy($id, UserService $service)
    {
        $service->destroy($id);
        return redirect()->route('dashboard');//fixme use route method for paths
    }

    //fixme define return type for functions
    public function standings(UserService $service)
    {
/*        $users = User::all() ;
        $list = [];
        foreach ($users as $user){
            $list[] = [$user->averAgeParticipating(), $user  ];
        }
        rsort($list);*/ //todo remove unused codes
        return view('standings' ,['users' => $service->standing() ]  ) ;
    }
}
