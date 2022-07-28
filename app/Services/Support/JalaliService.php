<?php

namespace App\Services\Support;


use Carbon\Carbon;

interface  JalaliService
{


    /**
     * @return string
     */
    public function toPersian(Carbon $carbon): string;


    /**
     * @return Carbon
     */
    public function toAd(string $format): Carbon;


}
