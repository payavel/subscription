<?php

namespace Payavel\Checkout;

use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->vendorPublish();
        }
    }

    protected function vendorPublish()
    {
        $this->publishes([
            __DIR__ . '/database/migrations/2023_01_01_000000_create_base_subscription_tables.php' => database_path('migrations/' . now()->format('Y_m_d_His') . '_create_base_subscription_tables.php'),
        ], 'migrations');
    }

    public function register()
    {
        // Register something...
    }
}
