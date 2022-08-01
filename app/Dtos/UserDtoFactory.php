<?php

namespace App\Dtos;

use App\Models\User;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

class UserDtoFactory
{
    public static function fromModel(User $user, string $avatar, float|string $userRate, string $userPerformanceColor, float $averageParticipating, $countBreakfast): UserDto
    {
        // persianFormat helper class did not work correctly, I had to handle it DASTY
        $createdAt = Jalalian::fromCarbon(new Carbon($user->created_at))->format('%A, %d %B %Y');

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
