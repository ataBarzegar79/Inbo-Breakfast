<?php

namespace App\Dtos;

use App\Models\User;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;


class UserDtoFactory
{
    public function fromModel(User $user): UserDto
    {
        $user_rate = $user->performance()['rate'];
        $user_performance_color = $user->performance()['color'];

        $user_avatar = $user->viewAvatar();

        // persianFormat helper class did not worked correctly, I had to handle it DASTY
        $created_at = Jalalian::fromCarbon(new Carbon($user->created_at))->format('%A, %d %B %Y');


        return new UserDto(
            $user->id,
            $user->name,
            $user->email,
            $created_at,
            $user->is_admin,
            $user_avatar,
            $user_rate,
            $user_performance_color,
        );
    }
}
