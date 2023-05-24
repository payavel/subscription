<?php

namespace Payavel\Subscription\Models\Traits;

use Payavel\Subscription\SubscriptionGateway;

trait ConfiguresSubscriptionGateway
{
    /**
     * The subscription's pre-configured gateway.
     *
     * @var \Payavel\Subscription\SubscriptionGateway
     */
    private $subscriptionGateway;

    /**
     * Retrieve the subscription's configured gateway.
     *
     * @return \Payavel\Subscription\SubscriptionGateway
     */
    public function getGatewayAttribute()
    {
        if (! isset($this->subscriptionGateway)) {
            $this->subscriptionGateway = (new SubscriptionGateway)
                ->provider($this->provider_id);;
        }

        return $this->subscriptionGateway;
    }
}
