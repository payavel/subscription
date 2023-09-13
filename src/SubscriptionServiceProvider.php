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
            return new SubscriptionGateway;
        });
    }

    protected function registerPublishableAssets()
    {
        $this->publishes([
            __DIR__ . '/../stubs/config.stub' => config_path('subscription.php'),
        ], 'subscription-config');

        $this->publishes([
            __DIR__ . '/../database/migrations/2023_01_01_000000_create_base_subscription_tables.php' => database_path('migrations/2023_01_01_000000_create_base_subscription_tables.php'),
        ], 'subscription-migrations');

        $this->publishes([
            __DIR__ . '/../stubs/subscription-request.stub' => base_path('stubs/serviceable/subscription/subscription-request.stub'),
            __DIR__ . '/../stubs/subscription-response.stub' => base_path('stubs/serviceable/subscription/subscription-response.stub'),
        ],'subscription-stubs');
    }

    protected function registerCommands()
    {
        $this->commands([
            MakeProvider::class,
        ]);
    }

    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
