<?php
namespace App\Services ;

use App\Dtos\UserDtoFactory;
use App\Models\User;

class UserCrudService implements UserService{
    public function index(): array
    {
        $users = User::all();

        foreach ($users as $user) {

            $user_factory = new UserDtoFactory();
            $user_dtos[] = $user_factory->fromModel($user);

        }

        return $user_dtos;
    }
}
