<?php

namespace Payavel\Subscription;

abstract class SubscriptionServiceDriver
{
    /**
     * Resolve the providable instance.
     *
     * @param \Payavel\Checkout\Contracts\Providable|string|int $provider
     * @return \Payavel\Checkout\Contracts\Providable|null
     */
    abstract public function resolveProvider($provider);

    /**
     * Get the default providable identifier.
     *
     * @return string|int
     */
    public function getDefaultProvider()
    {
        return config('subscription.defaults.provider');
    }

    /**
     * Resolve the gateway class.
     *
     * @param \Payavel\Checkout\Contracts\Providable $provider
     * @return string
     */
    abstract public function resolveGatewayClass($provider);
}
