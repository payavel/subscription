<?php

namespace Payavel\Subscription\Drivers;

use Payavel\Checkout\DataTransferObjects\Provider;
use Payavel\Subscription\SubscriptionServiceDriver;

class ConfigDriver extends SubscriptionServiceDriver
{
    /**
     * Collection of the application'n subscription providers.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $providers;

    public function __construct()
    {
        $this->providers = collect(config('subscription.providers'));
    }

    /**
     * Resolve the providable instance.
     *
     * @param \Payavel\Checkout\Contracts\Providable|string|int $provider
     * @return \Payavel\Checkout\Contracts\Providable|null
     */
    public function resolveProvider($provider)
    {
        if ($provider instanceof Provider) {
            return $provider;
        }

        if (is_null($attributes = $this->providers->get($provider))) {
            return null;
        }

        return new Provider(array_merge(['id' => $provider], $attributes));
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
