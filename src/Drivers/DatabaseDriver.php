<?php

namespace Payavel\Subscription\Drivers;

use Payavel\Subscription\Models\SubscriptionProvider;
use Payavel\Subscription\SubscriptionServiceDriver;

class DatabaseDriver extends SubscriptionServiceDriver
{
    /**
     * Resolve the providable instance.
     *
     * @param \Payavel\Checkout\Contracts\Providable|string|int $provider
     * @return \Payavel\Checkout\Contracts\Providable|null
     */
    public function resolveProvider($provider)
    {
        if (! $provider instanceof SubscriptionProvider) {
            $subscriptionProvider = config('subscription.models.' . SubscriptionProvider::class, SubscriptionProvider::class);

            $provider = $subscriptionProvider::find($provider);
        }

        if (is_null($provider) || (! $provider->exists)) {
            return null;
        }

        return $provider;
    }

    /**
     * Resolve the gateway class.
     *
     * @param \Payavel\Checkout\Contracts\Providable $provider
     * @return string
     */
    public function resolveGatewayClass($provider)
    {
        return $provider->request_class;
    }
}
