<?php

namespace Payavel\Subscription\Traits;

use Payavel\Subscription\Models\Subscription;

trait Subscribable
{
    /**
     * Get the subscribable's subscriptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function subscriptions()
    {
        return $this->morphMany(config('subscription.models.' . Subscription::class, Subscription::class), 'subscribable');
    }
}
