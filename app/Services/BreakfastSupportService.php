<?php

namespace App\Services;

use App\Models\Breakfast;

interface  BreakfastSupportService
{
    /**
     * @param Breakfast $breakfast will get the breakfast id and return it back ! to all service a property .
     */
    public function __construct(Breakfast $breakfast);

    /**
     * @return float
     */
    public function averageRate(): float;
}
