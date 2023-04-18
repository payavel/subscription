<?php

namespace Payavel\Subscription;

use Payavel\Checkout\Contracts\Providable;
use Payavel\Subscription\Contracts\SubscriptionRequestor;
use Payavel\Subscription\Traits\SubscriptionRequests;

abstract class SubscriptionRequest implements SubscriptionRequestor
{
    use SubscriptionRequests;

    /**
     * The subscription provider.
     *
     * @var \Payavel\Checkout\Contracts\Providable
     */
    protected $provider;

    /**
     * @param  \Payavel\Checkout\Contracts\Providable $provider
     * @param  \Payavel\Checkout\Contracts\Merchantable $merchant
     */
    public function __construct(Providable $provider)
    {
        $this->provider = $provider;

        $this->setUp();
    }

    /**
     * Set up the request.
     *
     * @return void
     */
    protected function setUp()
    {
        //
    }
}
