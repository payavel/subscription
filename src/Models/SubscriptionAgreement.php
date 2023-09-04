<?php

namespace Payavel\Subscription\Models;

use Illuminate\Database\Eloquent\Model;
use Payavel\Checkout\Models\PaymentMethod;
use Payavel\Serviceable\Traits\HasFactory;
use Payavel\Serviceable\Traits\ServesConfig;

class SubscriptionAgreement extends Model
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
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'next_billing_date' => 'date',
    ];

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
        return $this->belongsTo(
            $this->config(
                'checkout',
                'models.' . PaymentMethod::class,
                PaymentMethod::class
            )
        );
    }

    /**
     * Get the agreement's backup payment method.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function backupPaymentMethod()
    {
        return $this->belongsTo(
            $this->config(
                'checkout',
                'models.' . PaymentMethod::class,
                PaymentMethod::class
            )
        );
    }
}
