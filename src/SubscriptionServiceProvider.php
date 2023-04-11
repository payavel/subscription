<?php

namespace Payavel\Subscription;

use Illuminate\Support\ServiceProvider;

class SubscriptionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
            __DIR__ . '/stubs/migration-base.stub' => database_path('migrations/2023_01_01_000000_create_base_subscription_tables.php'),
        ], 'migrations');
    }

    public function register()
    {
        // Register something...
    }
}
