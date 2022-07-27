<?php

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;





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
