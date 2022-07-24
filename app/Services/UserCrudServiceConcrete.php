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

    public function store(storeUserRequest $request): array
    {

        $user_factory = new UserCreateDtoFactory();
        $user_dtos[] = $user_factory->fromRequest($request);

        return $user_dtos;

    }
}
