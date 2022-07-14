<?php

namespace App\Providers;

use App\Models\Breakfast;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use phpDocumentor\Reflection\Types\Mixed_;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return mixed
     */
    public function boot()
    {
        Gate::define('is_admin',  function( User $user ){
            return $user->is_admin === 'yes' ;

        }) ;

        Gate::define('canVote',  function(User $user, $breakfastId ){
            $rates =  Breakfast::find(intval($breakfastId))?->rates;
//            $x = Breakfast::all()->first(static function($rate) use($user) {
//               $rate->user_id === $user->id;
//            });
            foreach ($rates as $rate){
                if($rate->user_id === $user->id){
                    return  false ;
                }
            }
            return true ;

        }) ;


    }
}
