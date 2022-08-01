<?php

namespace App\Services\User;

use App\Dtos\UserDtoFactory;
use App\Dtos\UserRequestDto;
use App\Dtos\UserUpdateDtoFactory;
use App\Models\User;
use App\Services\Breakfast\BreakfastSupportService;
use JetBrains\PhpStorm\Pure;

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
        $avatarPath = $this->storeAvatar($dto);

        $newUser = User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
            'avatar' => $avatarPath,
            'is_admin' => $dto->is_admin
        ]);
        $newUser->save();
    }

    #[Pure] public function edit(User $user): object|bool
    {
        return UserUpdateDtoFactory::fromModel($user);
    }

    public function update(UserRequestDto $dto, User $user): void
    {
        $avatarPath = $this->storeAvatar($dto);

        $user->name = $dto->name;
        $user->email = $dto->email;
        $user->is_admin = $dto->is_admin;
        $user->avatar = $avatarPath;

        $user->save();
    }

    public function destroy(User $user): void
    {
        $user->delete();
    }

    public function storeAvatar(UserRequestDto $dto): string
    {
        if ($dto->avatar !== null) {
            $avatarExtension = '.' . $dto->avatar->extension();
            $emailPath = $dto->email;
            $avatarPath = 'avatars\\' . $emailPath . $avatarExtension;
            $avatarStorageAddress = $emailPath . $avatarExtension;
            $dto->avatar->storeAs(
                'avatars', $avatarStorageAddress, 'public'
            );
        } else {
            $avatarPath = "img\default.svg";
        }

        return $avatarPath;
    }

}
