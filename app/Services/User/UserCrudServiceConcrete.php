<?php

namespace App\Services\User;

use App\Dtos\Pagination\Pagination;
use App\Dtos\Pagination\UserPaginationDto;
use App\Dtos\Request\UserRequestDto;
use App\Dtos\User\UserDtoFactory;
use App\Dtos\User\UserUpdateDtoFactory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use JetBrains\PhpStorm\Pure;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserCrudServiceConcrete implements UserService
{
    /**
     * @throws UnknownProperties
     */
    public function index(): Pagination
    {
        $users = User::paginate(10);
        $userDtos = [];

        $userSupport = resolve(UserSupportService::class);
        foreach ($users->items() as $user) {
            $viewAvatar = $userSupport->viewAvatar($user);
            $performance = $userSupport->performance($user);
            $averAgeParticipating = $userSupport->userAverAgeParticipating($user);
            $countBreakfasts = $userSupport->countBreakfasts($user);
            $userDtos[] = UserDtoFactory::fromModel(
                $user,
                $viewAvatar,
                $performance,
                $averAgeParticipating,
                $countBreakfasts);
        }

        return UserPaginationDto::fromModelPaginatorAndData($users, $userDtos);
    }

    public function store(UserRequestDto $dto): void
    {

        $avatarPath = $this->storeAvatar($dto);

        $newUser = User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
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
        $user->password = Hash::make($dto->password) ;

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
            $avatarPath = "img\default.jpg";
        }

        return $avatarPath;
    }

    public function standing(): array
    {
        $users = User::all();

        $userSupport = resolve(UserSupportService::class);
        foreach ($users as $user) {
            $viewAvatar = $userSupport->viewAvatar($user);
            $performance = $userSupport->performance($user);
            $averAgeParticipating = $userSupport->userAverAgeParticipating($user);
            $countBreakfasts = $userSupport->countBreakfasts($user);
            $userDtos[] = UserDtoFactory::fromModel($user, $viewAvatar, $performance,  $averAgeParticipating, $countBreakfasts);
        }
        rsort($userDtos);

        return $userDtos;
    }

}
