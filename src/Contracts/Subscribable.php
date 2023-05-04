<?php

namespace Payavel\Subscription\Contracts;

interface Subscribable
{
    /**
     * Get the subscribable's subscriptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function subscriptions();
}
