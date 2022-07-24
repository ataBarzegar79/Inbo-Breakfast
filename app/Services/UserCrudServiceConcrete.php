<?php
namespace App\Services ;

use App\Dtos\UserCreateDtoFactory;
use App\Dtos\UserDtoFactory;
use App\Http\Requests\storeUserRequest;
use App\Models\User;

class UserCrudServiceConcrete implements UserService{
    public function index(): array
    {
        $users = User::all();

        foreach ($users as $user) {

            $user_factory = new UserDtoFactory();
            $user_dtos[] = $user_factory->fromModel($user);

        }

        return $user_dtos;
    }

    public function store(storeUserRequest $request): void
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

        $new_user = User::create([
            'name' => $request ->name ,
            'email' => $request ->email ,
            'password' => $request -> password ,
            'avatar' => 'avatars\\'.$avatar_path ,
            'is_admin' => $request->is_admin
        ]);

        $new_user->save();
    }
}
