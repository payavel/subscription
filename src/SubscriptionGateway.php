<?php

namespace Payavel\Subscription;

use BadMethodCallException;
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
        return tap($this->gateway->plans($subscriptionProduct))->configure(__FUNCTION__, $this->provider);
    }

    /**
     * Get all of the subscriber's active agreements.
     *
     * @param \Payavel\Subscription\Contracts\Subscribable $subscriber
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function listAgreements(Subscribable $subscriber)
    {
        return tap($this->gateway->listAgreements($subscriber))->configure(__FUNCTION__, $this->provider);
    }

    /**
     * Undocumented function
     *
     * @param \Payavel\Subscription\Models\Subscription $subscription
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function getAgreement(Subscription $subscription)
    {
        return tap($this->gateway->getAgreement($subscription))->configure(__FUNCTION__, $this->provider);
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
        return tap($this->gateway->createAgreement($subscriber, $data))->configure(__FUNCTION__, $this->provider);
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
        return tap($this->gateway->updateAgreement($subscription, $data))->configure(__FUNCTION__, $this->provider);
    }

    /**
     * Cancel a subscription agreement.
     *
     * @param \Payavel\Subscription\Models\Subscription $subscription
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function cancelAgreement(Subscription $subscription)
    {
        return tap($this->gateway->cancelAgreement($subscription))->configure(__FUNCTION__, $this->provider);
    }

    /**
     * Activate a previously canceled subscription agreement.
     *
     * @param \Payavel\Subscription\Models\Subscription $subscription
     * @return \Payavel\Subscription\SubscriptionResponse
     */
    public function activateAgreement(Subscription $subscription)
    {
        return tap($this->gateway->activateAgreement($subscription))->configure(__FUNCTION__, $this->provider);
    }

    /**
     * @param string $method
     * @param array $params
     * 
     * @throws \BadMethodCallException
     */
    public function __call($method, $params)
    {
        if (! method_exists($this->gateway, $method)) {
            throw new BadMethodCallException(__CLASS__ . "::{$method}() not found.");
        }

        return tap($this->gateway->{$method}(...$params))->configure($method, $this->provider);
    }
}
