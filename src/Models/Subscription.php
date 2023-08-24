<?php

namespace Payavel\Subscription\Models;

use Illuminate\Database\Eloquent\Model;
use Payavel\Subscription\Database\Factories\SubscriptionFactory;
use Payavel\Subscription\Models\Traits\SubscriptionRequests;

class Subscription extends Model
{
    use SubscriptionRequests;

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
        return SubscriptionFactory::new();
    }

    /**
     * Get the subscription's provider id.
     *
     * @return string|int
     */
    public function getProviderIdAttribute()
    {
        return $this->account->provider_id;
    }

    /**
     * Get this subscription's account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(config('subscription.models.' . SubscriptionAccount::class, SubscriptionAccount::class));
    }

    /**
     * Get the product this subscription relates to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(config('subscription.models.' . SubscriptionProduct::class, SubscriptionProduct::class));
    }
}
