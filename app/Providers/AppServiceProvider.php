<?php

namespace App\Providers;


use App\Services\Auth\AuthService;
use App\Services\Auth\AuthServiceConcrete;
use App\Services\Breakfast\BreakfastCrudService;
use App\Services\Breakfast\BreakfastService;
use App\Services\Breakfast\BreakfastAverageRateService;
use App\Services\Breakfast\BreakfastAverageRateServiceConcrete;
use App\Services\Rate\RateCreateService;
use App\Services\Rate\RateService;
use App\Services\Support\JalaliService;
use App\Services\Support\JalaliServiceConcrete;
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

        $this->app->singleton(BreakfastService::class, BreakfastCrudService::class);
        $this->app->singleton(RateService::class, RateCreateService::class);
        $this->app->bind(JalaliService::class, function () {
            return new JalaliServiceConcrete();
        });
        $this->app->singleton(AuthService::class, AuthServiceConcrete::class);
        $this->app->bind(BreakfastAverageRateService::class, function () {
            return new BreakfastAverageRateServiceConcrete();
        });

    }


}
