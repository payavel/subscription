<?php

namespace Payavel\Subscription\Traits;

use Payavel\Serviceable\Traits\ThrowsRuntimeException;
use Payavel\Subscription\Contracts\Subscribable;
use Payavel\Subscription\Models\Subscription;
use Payavel\Subscription\Models\SubscriptionProduct;

trait SubscriptionRequests
{
    use ThrowsRuntimeException;

    /**
     * Retrieve the product's active subscription plans.
     *
     * @param \Payavel\Subscription\Models\SubscriptionProduct $product
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function plans(SubscriptionProduct $product)
    {
        $this->throwRuntimeException(__FUNCTION__);
    }

    /**
     * Get all of the subscribable's active agreements.
     *
     * @param \Payavel\Subscription\Contracts\Subscribable $subscribable
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function listAgreements(Subscribable $subscribable)
    {
        $this->throwRuntimeException(__FUNCTION__);
    }

    /**
     * Get the subscription's agreement details.
     *
     * @param \Payavel\Subscription\Models\Subscription $subscription
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function getAgreement(Subscription $subscription)
    {
        $this->throwRuntimeException(__FUNCTION__);
    }

    /**
     * Create a new agreement for the subscribable.
     *
     * @param \Payavel\Subscription\Contracts\Subscribable $subscribable
     * @param array|mixed $data
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function createAgreement(Subscribable $subscribable, $data)
    {
        $this->throwRuntimeException(__FUNCTION__);
    }

    /**
     * Update an existing subscription agreement.
     *
     * @param \Payavel\Subscription\Models\Subscription $subscription
     * @param array|mixed $data
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function updateAgreement(Subscription $subscription, $data)
    {
        $this->throwRuntimeException(__FUNCTION__);
    }

    /**
     * Cancel a subscription agreement.
     *
     * @param \Payavel\Subscription\Models\Subscription $subscription
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function cancelAgreement(Subscription $subscription)
    {
        $this->throwRuntimeException(__FUNCTION__);
    }

    /**
     * Activate a previously canceled subscription agreement.
     *
     * @param \Payavel\Subscription\Models\Subscription $subscription
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function activateAgreement(Subscription $subscription)
    {
        $this->throwRuntimeException(__FUNCTION__);
    }
}
