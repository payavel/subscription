<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionProduct extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];

    /**
     * Get the Subscriptions' Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get the Plans' Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plans()
    {
        return $this->hasMany(SubscriptionPlan::class);
    }
}
