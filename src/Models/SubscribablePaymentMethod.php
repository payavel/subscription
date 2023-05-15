<?php

namespace Payavel\Subscription\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class SubscribablePaymentMethod extends MorphPivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
