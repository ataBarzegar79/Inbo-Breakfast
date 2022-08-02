<?php

namespace App\Services\Support;

use Carbon\Carbon;

interface  JalaliService
{
    /**
     * @param Carbon $carbon
     * @return string
     */
    public function toPersian(Carbon $carbon): string;

    /**
     * @param string $format
     * @return Carbon
     */
    public function toAd(string $format): Carbon;

}
