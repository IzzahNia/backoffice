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
        Gate::define('isAdmin', [RolePolicy::class, 'isAdmin']);
        Gate::define('isUser', [RolePolicy::class, 'isUser']);
        Gate::define('isVendor', [RolePolicy::class, 'isVendor']);
    }
}
