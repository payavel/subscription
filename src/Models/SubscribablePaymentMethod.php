<?php

namespace Payavel\Subscription\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class SubscribablePaymentMethod extends MorphPivot
{
    const PRIMARY_ROLE = 1;
    const BACKUP_ROLE = 2;


    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
