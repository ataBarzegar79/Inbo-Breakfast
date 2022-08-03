<?php

namespace App\Providers;

use App\Models\Breakfast;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('is_admin', function (User $user) {
            return $user->is_admin === 'yes';

        });

        Gate::define('canVote', function (User $user, $breakfastId) {
            $rates = Breakfast::find(intval($breakfastId))->rates;
            foreach ($rates as $rate) {
                if ($rate->user_id === $user->id) {
                    return false;
                }
            }
            return true;

        });
    }
}
