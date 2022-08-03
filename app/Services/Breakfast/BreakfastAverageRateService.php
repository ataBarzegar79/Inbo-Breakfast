<?php

namespace App\Services\Breakfast;

use App\Models\Breakfast;

interface  BreakfastAverageRateService
{
    /**
     * @param Breakfast $breakfast
     * @return float|string
     */
    public function averageRate(Breakfast $breakfast): float|string;
}
