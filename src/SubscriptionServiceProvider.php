<?php

namespace Payavel\Subscription;

use Illuminate\Support\ServiceProvider;

class SubscriptionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/stubs/config-publish.stub' => config_path('subscription.php'),
        ], 'payavel-config');

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
            __DIR__ . '/stubs/migration-base.stub' => database_path('migrations/2023_01_01_000000_create_base_subscription_tables.php'),
        ], 'migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/subscription.php',
            'subscription'
        );
    }
}
