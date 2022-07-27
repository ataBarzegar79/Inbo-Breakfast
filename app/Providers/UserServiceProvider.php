<?php

namespace App\Providers;

use App\Services\UserCrudServiceConcrete;
use App\Services\UserService;
use App\Services\UserSupportService;
use App\Services\UserSupportServiceConcrete;
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
