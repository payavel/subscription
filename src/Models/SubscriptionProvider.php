<?php

namespace Payavel\Subscription\Models;

use Illuminate\Database\Eloquent\Model;
use Payavel\Subscription\Database\Factories\SubscriptionProviderFactory;

class SubscriptionProvider extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return SubscriptionProviderFactory::new();
    }

    /**
     * Get the provider's related customers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customers()
    {
        return $this->hasMany(config('subscription.models.' . SubscriptionCustomer::class, SubscriptionCustomer::class), 'provider_id');
    }

    /**
     * Get the provider's related subscriptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function subscriptions()
    {
        return $this->hasManyThrough(
            config('subscription.models.' . Subscription::class, Subscription::class),
            config('subscription.models.' . SubscriptionCustomer::class, SubscriptionCustomer::class),
            'provider_id',
            'customer_id'
        );
    }
}
