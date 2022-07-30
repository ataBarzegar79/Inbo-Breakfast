<?php

namespace App\Providers;

use App\Models\Breakfast;
use App\Models\User;
use App\Services\Auth\AuthService;
use App\Services\Auth\AuthServiceConcrete;
use App\Services\Breakfast\BreakfastCrudService;
use App\Services\Breakfast\BreakfastService;
use App\Services\Breakfast\BreakfastSupportService;
use App\Services\Breakfast\BreakfastSupportServiceConcrete;
use App\Services\Rate\RateCreateService;
use App\Services\Rate\RateService;
use App\Services\Support\AverageParticipateService;
use App\Services\Support\AverageParticipateServiceConcrete;
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
        $this->app->bind(JalaliService::class, function () {
            return new JalaliServiceConcrete();
        });
        $this->app->singleton(AuthService::class, AuthServiceConcrete::class);
        $this->app->bind(BreakfastSupportService::class, function () {
            return new BreakfastSupportServiceConcrete();
        });
        $this->app->singleton(AverageParticipateService::class , AverageParticipateServiceConcrete::class);
    }


}
