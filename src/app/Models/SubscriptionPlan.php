<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];

    /**
     * Get the Product the Plan method belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(SubscriptionProduct::class);
    }

    /**
     * Get the Renew Period the Plan method belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function renewPeriod()
    {
        return $this->belongsTo(SubscriptionPeriod::class, 'renew_period_id');
    }

    /**
     * Get the Grace Period the Plan method belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gracePeriod()
    {
        return $this->belongsTo(SubscriptionPeriod::class, 'grace_period_id');
    }

    /**
     * Get the Trial Period the Plan method belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trialPeriod()
    {
        return $this->belongsTo(SubscriptionPeriod::class, 'trial_period_id');
    }

    /**
     * Get the Plans' Agreements
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function agreements()
    {
        return $this->hasMany(SubscriptionAgreement::class);
    }
}
