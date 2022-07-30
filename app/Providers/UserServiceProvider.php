<?php

namespace App\Providers;

use App\Services\User\UserCrudServiceConcrete;
use App\Services\User\UserService;
use App\Services\User\UserSupportService;
use App\Services\User\UserSupportServiceConcrete;
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
        $this->app->singleton(UserService::class, UserCrudServiceConcrete::class);
        $this->app->singleton(UserSupportService::class, UserSupportServiceConcrete::class);
    }
}
