<?php

namespace Payavel\Subscription\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionAgreement extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];

    /**
     * Retrieve the subscription agreement's plan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }
}
