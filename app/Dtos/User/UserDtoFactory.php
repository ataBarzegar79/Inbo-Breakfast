<?php

namespace App\Dtos\User;

use App\Models\User;
use App\Services\Support\JalaliService;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

class UserDtoFactory
{
    public static function fromModel(
        User         $user,
        string       $avatar,
        float|string $userRate,
        float        $averageParticipating,
        int          $countBreakfast
    ): UserDto
    {

        $jalaliService = resolve(JalaliService::class);
        $persianDateFormat = $jalaliService->toPersian($user->created_at);

        return new UserDto(
            $averageParticipating, // used it as first element for sorting
            $user->id,
            $user->name,
            $user->email,
            $user->password,
            $persianDateFormat,
            $user->is_admin,
            $avatar,
            $userRate,
            $countBreakfast,
        );
    }
}
