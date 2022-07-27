<?php

namespace App\Services;

use App\Models\Breakfast;

class BreakfastSupportServiceConcrete implements BreakfastSupportService
{
    public function __construct(Breakfast $breakfastId)
    {
        $this->breakfast = $breakfastId;
    }

    public function averageRate(): float
    {
        return $this->breakfast->rates->avg();
    }
}
