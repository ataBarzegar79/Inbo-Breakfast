<?php

namespace App\Services\Support;


use Carbon\Carbon;

interface  JalaliService
{
    /**
     * @param string $format
     */
    public function __construct(string $format);

    /**
     * @return string
     */
    public function toPersian(): string;


    /**
     * @return Carbon
     */
    public function toAd(): Carbon;


}
