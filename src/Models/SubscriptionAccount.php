<?php

namespace Payavel\Subscription\Models;

use Illuminate\Database\Eloquent\Model;
use Payavel\Serviceable\Traits\HasFactory;
use Payavel\Serviceable\Models\Provider;
use Payavel\Serviceable\Traits\ServesConfig;

class SubscriptionAccount extends Model
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
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['token'];

    /**
     * Get the provider this subscribable belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(
            $this->config(
                'subscription',
                'models.' . Provider::class,
                Provider::class
            )
        );
    }

    /**
     * Get the merchant this subscribable belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function merchant()
    {
        return $this->belongsTo(
            $this->config(
                'subscription',
                'models.' . Provider::class,
                Provider::class
            )
        );
    }

    /**
     * Get the subscribable model entity.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function subscribable()
    {
        return $this->morphTo();
    }

    /**
     * Get the customer's subscriptions.
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
            'account_id'
        );
    }
}
