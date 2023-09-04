<?php

namespace Payavel\Subscription\Models;

use Illuminate\Database\Eloquent\Model;
use Payavel\Serviceable\Traits\HasFactory;
use Payavel\Serviceable\Traits\ServesConfig;

class SubscriptionProduct extends Model
{
    use HasFactory,
        ServesConfig;

    /**
     * Custom factory namespace fallback.
     *
     * @var string
     */
    protected static $factoryNamespace = 'Payavel\\Subscription\\Database\\Factories';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];

    /**
     * Get the product's subscriptions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany(
            $this->config(
                'subscription',
                'models.' . Subscription::class,
                Subscription::class
            ),
            'product_id'
        );
    }

    /**
     * Get the product's related plans
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plans()
    {
        return $this->hasMany(SubscriptionPlan::class, 'product_id');
    }
}
