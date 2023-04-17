<?php

namespace Payavel\Subscription\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];

    /**
     * Get the Provider the Subscription method belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(config('subscription.models.' . SubscriptionProvider::class, SubscriptionProvider::class));
    }

    /**
     * Get the Product the Subscription method belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(config('subscription.models.' . SubscriptionProduct::class, SubscriptionProduct::class));
    }
}
