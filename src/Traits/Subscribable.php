<?php

namespace Payavel\Subscription\Traits;

use Payavel\Checkout\Models\PaymentMethod;
use Payavel\Serviceable\Traits\ServesConfig;
use Payavel\Subscription\Models\SubscribablePaymentMethod;
use Payavel\Subscription\Models\SubscriptionAccount;

trait Subscribable
{
    use ServesConfig;

    /**
     * Get the subscribable's account information at a provider level.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function accounts()
    {
        return $this->morphMany($this->config('subscription','models.' . SubscriptionAccount::class, SubscriptionAccount::class), 'subscribable');
    }

    /**
     * Get all the subscribable's payment methods.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function paymentMethods()
    {
        return $this->morphToMany(
            $this->config('checkout', 'models.' . PaymentMethod::class, PaymentMethod::class),
            'subscribable',
            'subscribable_payment_method'
        )
            ->using($this->config('subscription','models.' . SubscribablePaymentMethod::class, SubscribablePaymentMethod::class))
            ->withPivot('role');
    }

    /**
     * Get the subscribable's primary payment method.
     *
     * @return \Payavel\Checkout\Models\PaymentMethod|null
     */
    public function primaryPaymentMethod()
    {
        return $this->paymentMethods->first(function ($paymentMethod) {
            return $paymentMethod->pivot->role === SubscribablePaymentMethod::PRIMARY_ROLE;
        });
    }

    /**
     * Get the subscribable's backup payment method.
     *
     * @return \Payavel\Checkout\Models\PaymentMethod|null
     */
    public function backupPaymentMethod()
    {
        return $this->paymentMethods->first(function ($paymentMethod) {
            return $paymentMethod->pivot->role === SubscribablePaymentMethod::BACKUP_ROLE;
        });
    }

    /**
     * Retrieve the subscribable's primary payment method via model accessor.
     *
     * @return \Payavel\Checkout\Models\PaymentMethod|null
     */
    public function getPrimaryPaymentMethodAttribute()
    {
        return $this->primaryPaymentMethod();
    }

    /**
     * Retrieve the subscribable's backup payment method via model accessor.
     *
     * @return \Payavel\Checkout\Models\PaymentMethod|null
     */
    public function getBackupPaymentMethodAttribute()
    {
        return $this->backupPaymentMethod();
    }
}
