<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Subscription Test Mode
    |--------------------------------------------------------------------------
    |
    | When set to true, the provider is loaded into the fake subscription gateway which
    | will allow you to mock responses without having to initiate any http requests.
    | This is recommended when running the application in a testing environment.
    |
    */
    'test_mode' => false,

    /*
    |--------------------------------------------------------------------------
    | Subscription Service Drivers
    |--------------------------------------------------------------------------
    |
    | You may register custom subscription drivers and/or remove the default ones.
    | Note that in order for the driver to be compatible it must extend
    | the \Payavel\Subscription\SubscriptionServiceDriver::class.
    |
    */
    'drivers' => [
        'config' => \Payavel\Subscription\Drivers\ConfigDriver::class,
        'database' => \Payavel\Subscription\Drivers\DatabaseDriver::class,
    ],

];
