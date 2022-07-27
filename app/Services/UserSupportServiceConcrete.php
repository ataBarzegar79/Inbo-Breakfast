<?php

namespace App\Services;

use App\Models\User;
use DivisionByZeroError;

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

    public function performanceColor(int $userId, UserSupportService $service): string
    {
        $performance = $service->performance($userId);

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

}
