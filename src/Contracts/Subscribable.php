<?php

namespace Payavel\Subscription\Contracts;

interface Subscribable
{
    /**
     * Get the subscribable's account information at a provider level.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function accounts();

    /**
     * Get all of the subscribable's payment methods.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function paymentMethods();

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
