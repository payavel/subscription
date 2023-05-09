<?php

namespace Payavel\Subscription\Contracts;

interface Subscribable
{
    /**
     * Get the subscribable's subscriptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function subscriptions();

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
