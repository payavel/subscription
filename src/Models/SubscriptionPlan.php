<?php

namespace Payavel\Subscription\Models;

use Illuminate\Database\Eloquent\Model;
use Payavel\Subscription\Database\Factories\SubscriptionPlanFactory;

class SubscriptionPlan extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];

    /**
     * Get the product this plan relates to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(config('subscription.models.' . SubscriptionProduct::class, SubscriptionProduct::class));
    }

    /**
     * Get the plan's renew period.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function renewPeriod()
    {
        return $this->belongsTo(SubscriptionPeriod::class);
    }

    /**
     * Get the plan's grace period.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gracePeriod()
    {
        return $this->belongsTo(SubscriptionPeriod::class);
    }

    /**
     * Get the plan's trial period.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trialPeriod()
    {
        return $this->belongsTo(SubscriptionPeriod::class);
    }

    /**
     * Get the plan's subscription agreements.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function agreements()
    {
        return $this->hasMany(SubscriptionAgreement::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return SubscriptionPlanFactory::new();
    }
}
