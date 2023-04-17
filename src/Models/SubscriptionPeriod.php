<?php

namespace Payavel\Subscription\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPeriod extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];
}
