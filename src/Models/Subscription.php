<?php

namespace Payavel\Subscription\Models;

use Illuminate\Database\Eloquent\Model;
use Payavel\Serviceable\Traits\HasFactory;
use Payavel\Serviceable\Traits\ServesConfig;
use Payavel\Subscription\Models\Traits\SubscriptionRequests;

class Subscription extends Model
{
    use HasFactory,
        ServesConfig,
        SubscriptionRequests;

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
     * Get the subscription's provider id.
     *
     * @return string|int
     */
    public function getProviderIdAttribute()
    {
        return $this->account->provider_id;
    }

    /**
     * Get the subscription's merchant id.
     *
     * @return string|int
     */
    public function getMerchantIdAttribute()
    {
        return $this->account->merchant_id;
    }

    /**
     * Get this subscription's account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(
            $this->config(
                'subscription',
                'models.' . SubscriptionAccount::class,
                SubscriptionAccount::class
            )
        );
    }

    /**
     * Get the product this subscription relates to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(
            $this->config(
                'subscription',
                'models.' . SubscriptionProduct::class,
                SubscriptionProduct::class
            )
        );
    }
}
