<?php

namespace App\Services\Support;


use Carbon\Carbon;

interface  JalaliService
{
    /**
     * @param string $time
     * @return string
     */
    public function toPersian(string $time):string ;


    /**
     * @param string $persianFormat
     * @return Carbon
     */
    public function toAd(string $persianFormat):Carbon ;


}
