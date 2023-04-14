<?php

namespace Payavel\Subscription\Facades;

use Illuminate\Support\Facades\Facade;
use Payavel\Subscription\SubscriptionGateway;

/**
 * @method static \Payavel\Subscription\SubscriptionGateway provider($provider)
 * @method static \Payavel\Checkout\Contracts\Providable getProvider()
 * @method static void setProvider($provider)
 * @method static string|int getDefaultProvider()
 * TODO: Document the rest.
 * 
 * @see \Payavel\Subscription\SubscriptionGateway
 */
class Subscription extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return SubscriptionGateway::class;
    }
}
