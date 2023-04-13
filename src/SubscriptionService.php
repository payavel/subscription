<?php

namespace Payavel\Subscription;

use Exception;
use Payavel\Checkout\Traits\SimulateAttributes;

class SubscriptionService
{
    use SimulateAttributes;

    /**
     * The subscription service driver that will handle provider configurations.
     *
     * @var \Payavel\Subscription\SubscriptionServiceDriver
     */
    private $driver;

    /**
     * The subscription provider requests will be forwarded to.
     *
     * @var \Payavel\Checkout\Contracts\Providable
     */
    private $provider;

    /**
     * The gateway class where requests will be executed.
     *
     * @var \Payavel\Subscription\SubscriptionRequest
     */
    private $gateway;

    /**
     * Prepares the driver based on preference determined in config file.
     *
     * @return void
     *
     * @throws Exception
     */
    public function __construct()
    {
        if (! class_exists($driver = config('payment.drivers.' . config('payment.defaults.driver', 'config')))) {
            throw new Exception('The ' . $driver . '::class does not exist.');
        }

        $this->driver = new $driver;
    }

    /**
     * Fluent provider setter.
     *
     * @param \Payavel\Checkout\Contracts\Providable|string|int $provider
     * @return \Payavel\Subscription\SubscriptionService
     */
    public function provider($provider)
    {
        $this->setProvider($provider);

        return $this;
    }

    /**
     * Get the current payment provider.
     *
     * @return \Payavel\Checkout\Contracts\Providable
     */
    public function getProvider()
    {
        if (! isset($this->provider)) {
            $this->setProvider($this->getDefaultProvider());
        }

        return $this->provider;
    }

    /**
     * Set the payment provider.
     *
     * @param \Payavel\Checkout\Contracts\Providable|string|int $provider
     * @return void
     *
     * @throws Exception
     */
    public function setProvider($provider)
    {
        if (is_null($provider = $this->driver->resolveProvider($provider))) {
            throw new Exception('Invalid subscription service provider.');
        }

        $this->provider = $provider;

        $this->gateway = null;
    }

    /**
     * Get the default payment provider.
     *
     * @return string|int|\Payavel\Checkout\Contracts\Providable
     */
    public function getDefaultProvider()
    {
        return $this->driver->getDefaultProvider();
    }

    /**
     * Get the subscription gateway service.
     *
     * @return \Payavel\Subscription\SubscriptionRequest
     */
    protected function getGateway()
    {
        if (! isset($this->gateway)) {
            $this->setGateway();
        }

        return $this->gateway;
    }

    /**
     * Instantiate a new instance of the subscription gateway.
     *
     * @return void
     *
     * @throws Exception
     */
    protected function setGateway()
    {
        $provider = $this->getProvider();

        $gateway = config('subscription.test_mode', false)
            ? config('subscription.test.gateway', '\\App\\Services\\Subscriptions\\FakeSubscriptionRequest')
            : $this->driver->resolveGatewayClass($provider);

        if (! class_exists($gateway)) {
            throw new Exception('The ' . $gateway . '::class does not exist.');
        }

        $this->gateway = new $gateway($provider);
    }
}
