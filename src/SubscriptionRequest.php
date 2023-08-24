<?php

namespace Payavel\Subscription;

use Payavel\Serviceable\Contracts\Providable;
use Payavel\Subscription\Contracts\SubscriptionRequestor;
use Payavel\Subscription\Traits\SubscriptionRequests;

abstract class SubscriptionRequest implements SubscriptionRequestor
{
    use SubscriptionRequests;

    /**
     * The subscription provider.
     *
     * @var \Payavel\Serviceable\Contracts\Providable
     */
    protected $provider;

    /**
     * @param  \Payavel\Serviceable\Contracts\Providable $provider
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
