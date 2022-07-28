<?php

namespace App\Providers;

use App\Models\Breakfast;
use App\Models\User;
use App\Services\AuthService;
use App\Services\AuthServiceConcrete;
use App\Services\BreakfastCrudService;
use App\Services\BreakfastService;
use App\Services\BreakfastSupportService;
use App\Services\BreakfastSupportServiceConcrete;
use App\Services\RateCreateService;
use App\Services\RateService;
use App\Services\Support\JalaliService;
use App\Services\Support\JalaliServiceConcrete;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;


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
     * @return void
     */
    public function boot()
    {
        Gate::define('is_admin', function (User $user) {
            return $user->is_admin === 'yes';

        });

        Gate::define('canVote', function (User $user, $breakfastId) {
            $rates = Breakfast::find(intval($breakfastId))?->rates;
            foreach ($rates as $rate) {
                if ($rate->user_id === $user->id) {
                    return false;
                }
            }
            return true;

        });

        $this->app->singleton(BreakfastService::class, BreakfastCrudService::class);
        $this->app->singleton(RateService::class, RateCreateService::class);
        $this->app->singleton(JalaliService::class, function ($app, $time) {
            return new JalaliServiceConcrete($time[0]);
        });
        $this->app->singleton(AuthService::class, AuthServiceConcrete::class);
        $this->app->singleton(BreakfastSupportService::class, function ($app, $breakfast) {
            return new BreakfastSupportServiceConcrete($breakfast[0]);
        });
    }


}
