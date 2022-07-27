<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use DivisionByZeroError;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserSupportServiceConcrete implements UserSupportService
{
    //fixme define return type for functions *done
    //todo move business logic to service layer
    //fixme use dtos instead of maps for data transferring
    public function performance(int $userId): float|string
    {
        $breakfastsDone = User::find($userId)->breakfasts;
        $counter = 0;
        $sum = 0;
        foreach ($breakfastsDone as $breakfast) {
            $counter += 1;
            $sum += $breakfast->avareageRate();
        }

        try {
            $performance = round($sum / $counter, 2);
        } catch (DivisionByZeroError) {
            $performance = "No rates yet !"; //todo use translations for user messages
        }
        return $performance;
    }

    public function performanceColor(int $userId, float|string $performance): string
    {

        if ($performance >= 1 && $performance <= 4) {
            $color = "#ff8080"; //todo move view elements to view layer
        } elseif ($performance > 4 && $performance <= 6) {
            $color = "#f6c23e";
        } elseif ($performance > 6 && $performance <= 10) {
            $color = "#1cc88a";
        } else {
            $color = "#f8f9fc";
        }

        return $color;
    }

    public function viewAvatar(int $userId): string|UrlGenerator|Application
    {
        $user = User::find($userId);
        $url = url($user->avatar);
        if (str_contains($url, 'default.svg')) {
            return $url;
        } else {
            return asset(Storage::url($user->avatar));
        }
    }

    public function countBreakfasts(int $userId): int
    {
        $user = User::find($userId);
        return $user->breakfasts->whereNull('deleted_at')->count();
    }

    public function averAgeParticipating(int $userId): float
    {
        $user = User::find($userId);
        $breakfastCounts = $user->breakfasts->whereNull('deleted_at')->count();
        $userCreatedAt = Carbon::createFromFormat('Y-m-d  H:i:s', $user->created_at);
        $now = Carbon::now();
        $diff = $userCreatedAt->diffInDays($now) + 1;

        return round($breakfastCounts / $diff, 3);
    }

}
