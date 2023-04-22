<?php

namespace Payavel\Subscription;

use Illuminate\Support\ServiceProvider;
use Payavel\Subscription\Console\Commands\MakeProvider;

class SubscriptionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }
        
        $this->registerPublishableAssets();

        $this->registerCommands();

        $this->registerMigrations();
    }

    public function register()
    {
        $this->app->singleton(SubscriptionGateway::class, function ($app) {
            return new SubscriptionGateway();
        });

        $this->mergeConfigFrom(
            __DIR__ . '/config/subscription.php',
            'subscription'
        );
    }

    protected function registerPublishableAssets()
    {
        $this->publishes([
            __DIR__ . '/stubs/config-publish.stub' => config_path('subscription.php'),
        ], 'payavel-config');

        $this->publishes([
            __DIR__ . '/database/migrations/2023_01_01_000000_create_base_subscription_tables.php' => database_path('migrations/2023_01_01_000000_create_base_subscription_tables.php'),
        ], 'payavel-migrations');
    }

    protected function registerCommands()
    {
        $this->commands([
            MakeProvider::class,
        ]);
    }

    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }
}
