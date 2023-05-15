<?php

namespace Payavel\Subscription\Contracts;

interface Subscribable
{
    /**
     * Get the subscribable's customer information at a provider level.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function customers();

    /**
     * Get the subscribables preferred method of payment.
     *
     * @return \Payavel\Checkout\Models\PaymentMethod
     */
    public function primaryPaymentMethod();

    /**
     * Get the subscribables backup payment method.
     *
     * @return \Payavel\Checkout\Models\PaymentMethod
     */
    public function backupPaymentMethod();
}
