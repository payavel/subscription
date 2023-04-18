<?php

namespace Payavel\Subscription\Contracts;

use Payavel\Subscription\Contracts\Subscribable;
use Payavel\Subscription\Models\Subscription;
use Payavel\Subscription\Models\SubscriptionProduct;

interface SubscriptionRequestor
{
    /**
     * Retrieve the product's active subscription plans.
     *
     * @param \Payavel\Subscription\Models\SubscriptionProduct $product
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function plans(SubscriptionProduct $product);

    /**
     * Get all of the subscriber's active agreements.
     *
     * @param \Payavel\Subscription\Contracts\Subscribable $subscriber
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function listAgreements(Subscribable $subscriber);

    /**
     * Get the subscription's agreement details.
     *
     * @param \Payavel\Subscription\Models\Subscription $subscription
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function getAgreement(Subscription $subscription);

    /**
     * Create a new agreement for the subscriber.
     *
     * @param \Payavel\Subscription\Contracts\Subscribable $subscriber
     * @param array|mixed $data
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function createAgreement(Subscribable $subscriber, $data);

    /**
     * Update an existing subscription agreement.
     *
     * @param \Payavel\Subscription\Models\Subscription $subscription
     * @param array|mixed $data
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function updateAgreement(Subscription $subscription, $data);

    /**
     * Cancel a subscription agreement.
     *
     * @param \Payavel\Subscription\Models\Subscription $subscription
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function cancelAgreement(Subscription $subscription);

    /**
     * Activate a previously canceled subscription agreement.
     *
     * @param \Payavel\Subscription\Models\Subscription $subscription
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function activateAgreement(Subscription $subscription);
}
