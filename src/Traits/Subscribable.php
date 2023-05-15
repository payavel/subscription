<?php

namespace Payavel\Subscription\Traits;

use Payavel\Checkout\Models\PaymentMethod;
use Payavel\Subscription\Models\SubscriptionCustomer;

trait Subscribable
{
    /**
     * Get the subscribable's customer information at a provider level.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function customers()
    {
        return $this->morphMany(config('subscription.models.' . SubscriptionCustomer::class, SubscriptionCustomer::class), 'subscribable');
    }

    /**
     * Get the subscribables payment methods.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function paymentMethods()
    {
        return $this->morphToMany(
            config('payment.models.' . PaymentMethod::class, PaymentMethod::class),
            'subscribable',
            'subscribable_payment_method'
        )
            ->using(config('subscription.models.' . SubscribablePaymentMethod::class, SubscribablePaymentMethod::class))
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
            return $paymentMethod->pivot->role === config('subscription.payment_method_roles.primary');
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
            return $paymentMethod->pivot->role === config('subscription.payment_method_roles.backup');
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
