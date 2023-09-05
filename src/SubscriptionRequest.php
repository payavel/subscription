<?php

namespace Payavel\Subscription;

use Payavel\Serviceable\ServiceRequest;
use Payavel\Subscription\Contracts\SubscriptionRequestor;
use Payavel\Subscription\Traits\SubscriptionRequests;

abstract class SubscriptionRequest extends ServiceRequest implements SubscriptionRequestor
{
    use SubscriptionRequests;
}
