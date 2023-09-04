<?php

namespace Payavel\Subscription\Models;

use Illuminate\Database\Eloquent\Model;
use Payavel\Serviceable\Traits\HasFactory;
use Payavel\Serviceable\Traits\ServesConfig;

class SubscriptionPlan extends Model
{
    use HasFactory,
        ServesConfig;

    /**
     * Custom factory namespace fallback.
     *
     * @var string
     */
    protected static $factoryNamespace = 'Payavel\\Subscription\\Database\\Factories';

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
        return $this->belongsTo(
            $this->config(
                'subscription',
                'models.' . SubscriptionProduct::class,
                SubscriptionProduct::class
            )
        );
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
        return $this->hasMany(SubscriptionAgreement::class, 'plan_id');
    }
}
