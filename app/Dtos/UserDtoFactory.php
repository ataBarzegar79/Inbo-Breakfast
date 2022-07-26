<?php

namespace App\Dtos;

use App\Models\User;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

class UserDtoFactory
{
    //todo use static methods in dto facilities *done
    public static function fromModel(User $user): UserDto
    {
        //fixme use dtos instead of maps for data transferring
        $userRate = $user->performance()['rate'];//fixme use camelcase for variable names *done

        $userPerformanceColor = $user->performance()['color'];

        $userAvatar = $user->viewAvatar();

        $averageParticipating = $user->averAgeParticipating();

        $countBreakfast = $user->countBreakfasts();

        // persianFormat helper class did not worked correctly, I had to handle it DASTY
        $createdAt = Jalalian::fromCarbon(new Carbon($user->created_at))->format('%A, %d %B %Y');//fixme use camelcase for variable names


        return new UserDto(
            $user->id,
            $user->name,
            $user->email,
            $user->password,
            $createdAt,
            $user->is_admin,
            $userAvatar,
            $userRate,
            $userPerformanceColor,
            $averageParticipating,
            $countBreakfast,
        );
    }
}
