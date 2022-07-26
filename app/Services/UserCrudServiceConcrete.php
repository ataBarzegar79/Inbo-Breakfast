<?php

namespace App\Services;

use App\Dtos\UserCreateDtoFactory;
use App\Dtos\UserDtoFactory;
use App\Http\Requests\storeUserRequest;
use App\Http\Requests\updateUserRequest;
use App\Models\User;

class UserCrudServiceConcrete implements UserService
{
    public function index(): array
    {
        $users = User::all();
        $userDtos = [];

        foreach ($users as $user) {
            $userFactory = new UserDtoFactory();
            $userDtos[] = $userFactory->fromModel($user);
        }

        return $userDtos;
    }


    public function store(storeUserRequest $request): void
    {
        if ($request->avatar !== null) {
            $avatarExtension = '.' . $request->avatar->extension();
            $emailPath = $request->email;//fixme use camelcase for variable names   :Done
            $avatarPath = 'avatars\\' . $emailPath . $avatarExtension;
            $avatarStorageAddress = $emailPath . $avatarExtension;
            $request->file('avatar')->storeAs(
                'avatars', $avatarStorageAddress, 'public'
            );
        } else {
            $avatarPath = "img\default.svg";
        }

        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'avatar' => $avatarPath,
            'is_admin' => $request->is_admin
        ]);

        $newUser->save();
    }


    //fixme define return type for functions  :Done
    public function edit(int $id): object|bool
    {
        $user = User::find($id);
        if (!$user) {
            return false;
        }

        $newUserFactory = new UserDtoFactory();//fixme use camelcase for variable names :Done
        return $newUserFactory->fromModel($user);
    }

    //fixme define return type for functions :Done
    public function update(updateUserRequest $request, int $id):void
    {
        if ($request->avatar !== null) {
            $avatarExtension = '.' . $request->avatar->extension();//fixme use camelcase for variable names
            $emailPath = $request->email;
            $avatarPath = 'avatars\\' . $emailPath . $avatarExtension;
            $avatarStorageAddress = $emailPath . $avatarExtension;
            $request->file('avatar')->storeAs(
                'avatars', $avatarStorageAddress, 'public'
            );
        } else {
            $avatarPath = "img\default.svg";
        }

        $updated_user = User::find($id);
        $updated_user->name = $request->name;
        $updated_user->email = $request->email;
        $updated_user->is_admin = $request->is_admin;
        $updated_user->avatar = $avatarPath;

        $updated_user->save();
    }

    public function destroy(int $id): void
    {
        $deletedUser = User::find($id);
        $deletedUser->delete();
    }

    public function standing(): array
    {
        $users = User::all();
        foreach ($users as $user) {
            $userFactory = new UserDtoFactory();//fixme use camelcase for variable names
            $userDto = $userFactory->fromModel($user);
            $userDtos[] = ['average' => $userDto->averageParticipating, 'dto' => $userDto];
        }

        rsort($userDtos);
        return $userDtos;
    }
}
