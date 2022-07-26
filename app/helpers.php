<?php

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

//fixme use services for business logic

//fixme define return type for functions
function persianFormat($format){
    return Jalalian::fromCarbon(new Carbon($format))->format('%A, %d %B %Y');
}


//fixme define return type for functions
function averageParticipationUsers(){
    //todo replace inline namespaces with imports
    $users = \App\Models\User::all() ;
    $users_count = $users->count() ;//fixme use camelcase for variable names
    $sum = 0 ;
    foreach ($users as $user) {
        $sum += $user ->averAgeParticipating() ;
    }

    return round($sum/$users_count  , 3 );
}
