<?php
namespace App\Services ;

use App\Dtos\UserCreateDtoFactory;
use App\Dtos\UserDtoFactory;
use App\Http\Requests\storeUserRequest;
use App\Http\Requests\updateUserRequest;
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
            $email_path = $request->email;//fixme use camelcase for variable names
            $avatar_path = 'avatars\\'.$email_path.$avatar_extension ;
            $avatar_storage_adress = $email_path.$avatar_extension ;
            $Avatar_saving = $request->file('avatar')->storeAs(
                'avatars', $avatar_storage_adress, 'public'
            );
        }
        else{
            $avatar_path = "img\default.svg" ;
        }

        $new_user = User::create([
            'name' => $request ->name ,
            'email' => $request ->email ,
            'password' => $request -> password ,
            'avatar' => $avatar_path ,
            'is_admin' => $request->is_admin
        ]);

        $new_user->save();
    }

    //fixme define return type for functions
    public function edit(int $id)
    {
        if(!$user = User::find($id)){
            return redirect()->route('dashboard') ;
        }

        $user = User::find($id);
        $new_user_factory = new UserDtoFactory();//fixme use camelcase for variable names
        $user_dto = $new_user_factory->fromModel($user);

        return $user_dto;
    }

    //fixme define return type for functions
    public function update(updateUserRequest $request, int $id)
    {
        if($request->avatar !== null) {

            $avatar_extension = '.' . $request->avatar->extension();//fixme use camelcase for variable names
            $email_path = $request->email;
            $avatar_path = 'avatars\\'.$email_path.$avatar_extension ;
            $avatar_storage_adress = $email_path.$avatar_extension ;
            $Avatar_saving = $request->file('avatar')->storeAs(
                'avatars', $avatar_storage_adress, 'public'
            );
        }
        else{
            $avatar_path = "img\default.svg" ;
        }

        $updated_user = User::find($id) ;
        $updated_user->name = $request->name ;
        $updated_user->email = $request->email;
        $updated_user->is_admin = $request->is_admin ;
        $updated_user ->avatar = $avatar_path;

        $updated_user->save() ;
    }

    public function destroy(int $id): void
    {
        $deleted_user = User::find($id);
        $deleted_user->delete() ;
    }

    public function standing(): array
    {
        $users = User::all();

        foreach ($users as $user) {

            $user_factory = new UserDtoFactory();//fixme use camelcase for variable names
            $user_dto = $user_factory->fromModel($user);
            $user_dtos[] = ['average'=>$user_dto->averageParticipating ,'dto'=> $user_dto];

        }

        rsort($user_dtos);

        return $user_dtos;
    }
}
