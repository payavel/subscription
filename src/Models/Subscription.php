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
     * Get this subscription's customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(config('subscription.models.' . SubscriptionCustomer::class, SubscriptionCustomer::class));
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
