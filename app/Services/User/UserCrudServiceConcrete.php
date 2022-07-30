<?php

namespace App\Services\User;

use App\Dtos\UserDtoFactory;
use App\Dtos\UserUpdateDtoFactory;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\Breakfast\BreakfastSupportService;

class UserCrudServiceConcrete implements UserService
{
    public function index(BreakfastSupportService $breakfastSupportService): array
    {
        $users = User::all();
        $userDtos = [];

        $userSupport = resolve(UserSupportService::class);
        foreach ($users as $user) {
            $viewAvatar = $userSupport->viewAvatar($user->id);
            $performance = $userSupport->performance($user->id);
            $performanceColor = $userSupport->performanceColor($user->id, $performance);
            $averAgeParticipating = $userSupport->averAgeParticipating($user->id);
            $countBreakfasts = $userSupport->countBreakfasts($user->id);
            $userDtos[] = UserDtoFactory::fromModel($user, $viewAvatar, $performance, $performanceColor, $averAgeParticipating, $countBreakfasts);
        }

        return $userDtos;
    }

    public function store(StoreUserRequest $request): void
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
        return UserUpdateDtoFactory::fromModel($user);
    }

    //fixme define return type for functions :Done
    public function update(UpdateUserRequest $request, int $id): void
    {
        if ($request->avatar !== null) {
            $avatarExtension = '.' . $request->avatar->extension();//fixme use camelcase for variable names :Done
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

    public function standing(BreakfastSupportService $breakfastSupportService): array
    {
        $users = User::all();

        $userSupport = resolve(UserSupportService::class);
        foreach ($users as $user) {
            $viewAvatar = $userSupport->viewAvatar($user->id);
            $performance = $userSupport->performance($user->id);
            $performanceColor = $userSupport->performanceColor($user->id, $performance);
            $averAgeParticipating = $userSupport->averAgeParticipating($user->id);
            $countBreakfasts = $userSupport->countBreakfasts($user->id);
            $userDtos[] = UserDtoFactory::fromModel($user, $viewAvatar, $performance, $performanceColor, $averAgeParticipating, $countBreakfasts);
        }
        rsort($userDtos);
        return $userDtos;
    }

}
