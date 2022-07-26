<?php

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

function persianFormat($format){
    return Jalalian::fromCarbon(new Carbon($format))->format('%A, %d %B %Y');
}


function averageParticipationUsers(){
    $users = \App\Models\User::all() ;
    $users_count = $users->count() ;
    $sum = 0 ;
    foreach ($users as $user) {
        $sum += $user ->averAgeParticipating() ;
    }

    return round($sum/$users_count  , 3 );
}
