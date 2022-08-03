<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\Breakfast\BreakfastAverageRateService;
use DivisionByZeroError;
use TypeError;

class UserPerformanceServiceConcrete implements UserPerformanceService
{
    public function performance(User $user): float|string
    {
        $breakfastsDone = $user->breakfasts;
        $counter = 0;
        $sum = 0;

        $breakfastSupport = resolve(BreakfastAverageRateService::class);
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
            $performance = "No rates yet !";
        }
        return $performance;
    }
}
