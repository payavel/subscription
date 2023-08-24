<?php

namespace Payavel\Subscription\Models\Traits;

trait SubscriptionRequests
{
    use ConfiguresSubscriptionGateway;

    /**
     * Fetch the Subscription details.
     *
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function fetch()
    {
        return $this->gateway->getAgreement($this);
    }
}
