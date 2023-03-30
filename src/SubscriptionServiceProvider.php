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
        // Publish something...
    }

    public function register()
    {
        // Register something...
    }
}
