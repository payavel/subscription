<?php

namespace Payavel\Subscription;

use Payavel\Subscription\Contracts\Subscribable;
use Payavel\Subscription\Contracts\SubscriptionRequestor;
use Payavel\Subscription\Models\Subscription;
use Payavel\Subscription\Models\SubscriptionProduct;

class SubscriptionGateway extends SubscriptionService implements SubscriptionRequestor
{
    /**
     * Retrieve the product's active subscription plans.
     *
     * @param \Payavel\Subscription\Models\SubscriptionProduct $product
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function plans(SubscriptionProduct $subscriptionProduct)
    {
        
    }

    /**
     * Get all of the subscriber's active agreements.
     *
     * @param \Payavel\Subscription\Contracts\Subscribable $subscriber
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function listAgreements(Subscribable $subscriber)
    {

    }

    /**
     * Undocumented function
     *
     * @param \Payavel\Subscription\Models\Subscription $subscription
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function getAgreement(Subscription $subscription)
    {

    }

    /**
     * Create a new agreement for the subscriber.
     *
     * @param \Payavel\Subscription\Contracts\Subscribable $subscriber
     * @param array|mixed $data
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function createAgreement(Subscribable $subscriber, $data)
    {

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

    }

    /**
     * Cancel a subscription agreement.
     *
     * @param \Payavel\Subscription\Models\Subscription $subscription
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function cancelAgreement(Subscription $subscription)
    {

    }

    /**
     * Reactivate a previously canceled subscription agreement.
     *
     * @param \Payavel\Subscription\Models\Subscription $subscription
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function reactivateAgreement(Subscription $subscription)
    {

    }
}
