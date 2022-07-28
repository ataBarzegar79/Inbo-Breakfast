<?php


namespace App\Services\Support;

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

class JalaliServiceConcrete implements JalaliService
{

    public function toPersian(Carbon $carbon): string
    {
        return Jalalian::fromCarbon($carbon)->format('%A, %d %B %Y');
    }

    public function toAd(string $format): Carbon
    {
        $persianDate = explode("/", $format);
        return (new Jalalian((int)$persianDate[0], (int)$persianDate[1], (int)$persianDate[2], 0, 0, 0))->toCarbon();

    }

}
