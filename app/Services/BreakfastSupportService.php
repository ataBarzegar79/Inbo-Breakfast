<?php

namespace App\Services;

use App\Models\Breakfast;

interface  BreakfastSupportService
{
    /**
     * @param Breakfast $breakfast
     * @return float|string
     */
    public function averageRate(Breakfast $breakfast): float|string;
}
