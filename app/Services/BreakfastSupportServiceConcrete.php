<?php

namespace App\Services;

use App\Models\Breakfast;

class BreakfastSupportServiceConcrete implements BreakfastSupportService
{
    public function __construct(Breakfast $breakfast)
    {
        $this->breakfast = $breakfast;
    }

    public function averageRate(): float|string
    {
        try {
            return $this->breakfast->rates->avg('rate');
        } catch (\TypeError) {
            return "No rates Yet ! ";
        }
    }
}
