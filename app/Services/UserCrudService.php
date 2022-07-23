<?php
namespace App\Services ;

use App\Dtos\UserDtoFactory;
use App\Models\User;

class UserCrudService implements UserService{
    public function index()
    {
        $users = User::all();

        foreach ($users as $user){
            $user_performance = $user->performance()['rate'];
            $user_color = $user->performance()['color'];
            $user_avatar = $user->viewAvatar();
        }

        $user_factory = new UserDtoFactory();
        $user_dtos[] = $user_factory->fromModel($users, $user_performance, $user_color, $user_avatar);

        return $user_dtos;
    }
}
