<?php

namespace App\Services\Breakfast;

use App\Models\Breakfast;

class BreakfastSupportServiceConcrete implements BreakfastSupportService
{

    public function averageRate(Breakfast $breakfast): float|string
    {
        try {
            return $breakfast->rates->avg('rate');
        } catch (\TypeError) {
            return "No rates Yet ! ";
        }
    }
}
