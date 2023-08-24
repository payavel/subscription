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

    'payment_method_roles' => [
        'primary' => 1,
        'backup' => 2,
    ],

];
