<?php

namespace Payavel\Subscription\Facades;

use Illuminate\Support\Facades\Facade;
use Payavel\Subscription\SubscriptionGateway;

/**
 * @method static \Payavel\Subscription\SubscriptionGateway provider($provider)
 * @method static \Payavel\Serviceable\Contracts\Providable getProvider()
 * @method static void setProvider($provider)
 * @method static string|int|\Payavel\Serviceable\Contracts\Providable getDefaultProvider()
 * @method static \Payavel\Subscription\SubscriptionGateway merchant($merchant)
 * @method static \Payavel\Serviceable\Contracts\Merchantable getMerchant()
 * @method static void setMerchant($merchant)
 * @method static string|int|\Payavel\Serviceable\Contracts\Merchantable getDefaultMerchant()
 * @method static void reset()
 * TODO: Document the rest once defined.
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
