<?php

namespace Payavel\Subscription\Models;

use Illuminate\Database\Eloquent\Model;
use Payavel\Checkout\Models\PaymentMethod;
use Payavel\Subscription\Database\Factories\SubscriptionAgreementFactory;

class SubscriptionAgreement extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'next_billing_date' => 'date',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return SubscriptionAgreementFactory::new();
    }

    /**
     * Retrieve the subscription agreement's plan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }

    /**
     * Get the agreement's primary payment method.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function primaryPaymentMethod()
    {
        return $this->belongsTo(config('payment.models.' . PaymentMethod::class, PaymentMethod::class));
    }

    /**
     * Get the agreement's backup payment method.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function backupPaymentMethod()
    {
        return $this->belongsTo(config('payment.models.' . PaymentMethod::class, PaymentMethod::class));
    }
}
