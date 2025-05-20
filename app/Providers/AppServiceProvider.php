<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\RolePolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register the RolePolicy globally
        Gate::define('isAdmin', function ($user) {
            return (new RolePolicy)->isAdmin($user);
        });
        Gate::define('isUser', function ($user) {
            return (new RolePolicy)->isUser($user);
        });
        Gate::define('isVendor', function ($user) {
            return (new RolePolicy)->isVendor($user);
        });
        Gate::define('isCrew', function ($user) {
            return (new RolePolicy)->isCrew($user);
        });
        Gate::define('isCollab', function ($user) {
            return (new RolePolicy)->isCollab($user);
        });
    }
}
