<?php

namespace Payavel\Subscription;

use Payavel\Serviceable\ServiceResponse;
use Payavel\Subscription\Traits\SubscriptionResponses;
use Payavel\Subscription\Contracts\SubscriptionResponder;

abstract class SubscriptionResponse extends ServiceResponse implements SubscriptionResponder
{
    use SubscriptionResponses;

    /**
     * Statuses in this array are considered successful.
     *
     * @var array
     */
    protected $successStatuses = [
        SubscriptionStatus::REQUEST_SUCCESS,
    ];

    /**
     * Get a string representation of the response's status.
     *
     * @return string|null
     */
    public function getStatus()
    {
        return SubscriptionStatus::get($this->getStatusCode());
    }

    /**
     * Get a description of the response's status.
     *
     * @return string|null
     */
    public function getMessage()
    {
        return SubscriptionStatus::getMessage($this->getStatusCode());
    }
}
