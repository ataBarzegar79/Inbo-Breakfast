<?php

namespace App\Providers;

use App\Services\User\UserCountBreakfastsService;
use App\Services\User\UserCountBreakfastsServiceConcrete;
use App\Services\User\UserCrudCrudServiceConcrete;
use App\Services\User\UserCrudService;
use App\Services\User\UserParticipatingPerTimeService;
use App\Services\User\UserParticipatingPerTimeServiceConcrete;
use App\Services\User\UserPerformanceService;
use App\Services\User\UserPerformanceServiceConcrete;
use App\Services\User\UsersParticipateAverageService;
use App\Services\User\UsersParticipateAverageServiceConcrete;
use App\Services\User\UserViewAvatarService;
use App\Services\User\UserViewAvatarServiceConcrete;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(
            UserCrudService::class,
            UserCrudCrudServiceConcrete::class
        );
        $this->app->singleton(
            UserCountBreakfastsService::class,
            UserCountBreakfastsServiceConcrete::class
        );
        $this->app->singleton(
            UserParticipatingPerTimeService::class,
            UserParticipatingPerTimeServiceConcrete::class
        );
        $this->app->singleton(
            UserPerformanceService::class,
            UserPerformanceServiceConcrete::class
        );
        $this->app->singleton(
            UsersParticipateAverageService::class,
            UsersParticipateAverageServiceConcrete::class
        );
        $this->app->singleton(
            UserViewAvatarService::class,
            UserViewAvatarServiceConcrete::class
        );
    }
}
