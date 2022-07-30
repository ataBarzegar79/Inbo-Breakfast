<?php

namespace App\Services\User;

use App\Dtos\UserDtoFactory;
use App\Dtos\UserRequestDto;
use App\Dtos\UserUpdateDtoFactory;
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

    public function store(UserRequestDto $dto): void
    {
        if ($dto->avatar !== null) {
            $avatarExtension = '.' . $dto->avatar->extension();
            $emailPath = $dto->email;//fixme use camelcase for variable names   :Done
            $avatarPath = 'avatars\\' . $emailPath . $avatarExtension;
            $avatarStorageAddress = $emailPath . $avatarExtension;
            $dto->avatar->storeAs(
                'avatars', $avatarStorageAddress, 'public'
            );
        } else {
            $avatarPath = "img\default.svg";
        }

        $newUser = User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
            'avatar' => $avatarPath,
            'is_admin' => $dto->is_admin
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
    public function update(UserRequestDto $dto, int $id): void
    {
        if ($dto->avatar !== null) {
            $avatarExtension = '.' . $dto->avatar->extension();//fixme use camelcase for variable names :Done
            $emailPath = $dto->email;
            $avatarPath = 'avatars\\' . $emailPath . $avatarExtension;
            $avatarStorageAddress = $emailPath . $avatarExtension;
            $dto->avatar->storeAs(
                'avatars', $avatarStorageAddress, 'public'
            );
        } else {
            $avatarPath = "img\default.svg";
        }

        $updated_user = User::find($id);
        $updated_user->name = $dto->name;
        $updated_user->email = $dto->email;
        $updated_user->is_admin = $dto->is_admin;
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
