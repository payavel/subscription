<?php

namespace Payavel\Subscription\Models;

use Illuminate\Database\Eloquent\Model;
use Payavel\Subscription\Database\Factories\SubscriptionAccountFactory;

class SubscriptionAccount extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['token'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return SubscriptionAccountFactory::new();
    }

    /**
     * Get the provider this subscribable belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(config('subscription.models.' . SubscriptionProvider::class, SubscriptionProvider::class));
    }

    /**
     * Get the subscribable model entity.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function subscribable()
    {
        return $this->morphTo();
    }

    /**
     * Get the customer's subscriptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany(config('subscription.models.' . Subscription::class, Subscription::class), 'customer_id');
    }
}
