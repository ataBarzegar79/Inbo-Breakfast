<?php


namespace  App\Services\Support ;

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

class JalaliServiceConcrete implements JalaliService{
    public function __construct(string $format)
    {
         $this->format = $format;
    }

    public  function toPersian(): string
    {
        return Jalalian::fromCarbon(new Carbon($this->format))->format('%A, %d %B %Y');
    }

    public  function toAd(): Carbon
    {
        $persianDate = explode("/", $this->format);
        return (new Jalalian((int)$persianDate[0], (int)$persianDate[1], (int)$persianDate[2], 0, 0, 0))->toCarbon();

    }

}
