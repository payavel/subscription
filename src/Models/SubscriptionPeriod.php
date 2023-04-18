<?php

namespace Payavel\Subscription\Models;

use Illuminate\Database\Eloquent\Model;
use Payavel\Subscription\Database\Factories\SubscriptionPeriodFactory;

class SubscriptionPeriod extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return SubscriptionPeriodFactory::new();
    }
}
