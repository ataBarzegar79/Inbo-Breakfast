<?php


namespace  App\Services\Support ;

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

class JalaliServiceConcrete implements JalaliService{

    public function toPersian(string $adFormat): string
    {
        return Jalalian::fromCarbon(new Carbon($adFormat))->format('%A, %d %B %Y');
    }

    public function toAd(string $persianFormat): Carbon
    {
        $persianDate = explode("/", $persianFormat);
        return (new Jalalian((int)$persianDate[0], (int)$persianDate[1], (int)$persianDate[2], 0, 0, 0))->toCarbon();

    }

}
