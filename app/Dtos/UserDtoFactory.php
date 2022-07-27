<?php

namespace App\Dtos;

use App\Models\User;
use App\Services\UserSupportService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Morilog\Jalali\Jalalian;

class UserDtoFactory
{
    //todo use static methods in dto facilities *done
    public static function fromModel(User $user, UserSupportService $service): UserDto
    {

        $avatar = $service->viewAvatar($user->id);

        $userRate = $service->performance($user->id);

        $userPerformanceColor = $service->performanceColor($user->id, $userRate);

        $averageParticipating = $service->averAgeParticipating($user->id);

        $countBreakfast = $service->countBreakfasts($user->id);

        // persianFormat helper class did not work correctly, I had to handle it DASTY
        $createdAt = Jalalian::fromCarbon(new Carbon($user->created_at))->format('%A, %d %B %Y');//fixme use camelcase for variable names


        return new UserDto(
            $user->id,
            $user->name,
            $user->email,
            $user->password,
            $createdAt,
            $user->is_admin,
            $avatar,
            $userRate,
            $userPerformanceColor,
            $averageParticipating,
            $countBreakfast,
        );
    }
}
