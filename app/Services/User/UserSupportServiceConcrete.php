<?php

namespace App\Services\User;

use App\Models\Breakfast;
use App\Models\User;
use App\Services\Breakfast\BreakfastSupportService;
use Carbon\Carbon;
use DivisionByZeroError;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\Storage;
use TypeError;
use function App\Services\str_contains;
use function asset;
use function url;

class UserSupportServiceConcrete implements UserSupportService
{
    public function performance(int $userId): float|string
    {
        $breakfastsDone = Breakfast::findByUser($userId)->get();
        $counter = 0;
        $sum = 0;

        $breakfastSupport = resolve(BreakfastSupportService::class);
        foreach ($breakfastsDone as $breakfast) {
            try {
                $sum += $breakfastSupport->averageRate($breakfast);
                $counter += 1;
            } catch (TypeError) {
                continue;
            }

        }

        try {
            $performance = round($sum / $counter, 2);
        } catch (DivisionByZeroError) {
            $performance = "No rates yet !"; //todo use translations for user messages
        }
        return $performance;
    }


    public function viewAvatar(int $userId): string|UrlGenerator|Application
    {
        $user = User::find($userId);
        $url = url($user->avatar);
        if (\str_contains($url, 'default.jpg')) {
            return $url;
        } else {
            return asset(Storage::url($user->avatar));
        }
    }

    public function countBreakfasts(int $userId): int
    {
        return Breakfast::notDeleted()->findByUser($userId)->count();
    }

    public function userAverAgeParticipating(int $userId): float
    {
        $user = User::where('id', $userId)->first();
        $breakfastCounts = Breakfast::notDeleted()->findByUser($userId)->count(); //scopes
        $userCreatedAt = Carbon::createFromFormat('Y-m-d  H:i:s', $user->created_at);
        $now = Carbon::now();
        $diff = $userCreatedAt->diffInDays($now) + 1;

        return round($breakfastCounts / $diff, 3);
    }

}
