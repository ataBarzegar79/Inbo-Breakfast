<?php

namespace App\Dtos;

use App\Models\User;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;


class UserDtoFactory
{
    //todo use static methods in dto facilities
    public function fromModel(User $user): UserDto
    {
        //fixme use dtos instead of maps for data transferring
        $user_rate = $user->performance()['rate'];//fixme use camelcase for variable names
        $user_performance_color = $user->performance()['color'];

        $user_avatar = $user->viewAvatar();

        $averageParticipating = $user->averAgeParticipating();

        $countBreakfast = $user->countBreakfasts();

        // persianFormat helper class did not worked correctly, I had to handle it DASTY
        $created_at = Jalalian::fromCarbon(new Carbon($user->created_at))->format('%A, %d %B %Y');//fixme use camelcase for variable names


        return new UserDto(
            $user->id,
            $user->name,
            $user->email,
            $user->password,
            $created_at,
            $user->is_admin,
            $user_avatar,
            $user_rate,
            $user_performance_color,
            $averageParticipating,
            $countBreakfast,
        );
    }
}
