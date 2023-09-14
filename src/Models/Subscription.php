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
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];

    /**
     * Get the subscription's provider.
     *
     * @return string|int
     */
    public function getProviderAttribute()
    {
        return $this->account->provider;
    }

    /**
     * Get the subscription's merchant.
     *
     * @return string|int
     */
    public function getMerchantAttribute()
    {
        return $this->account->merchant;
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

    /**
     * Custom factory namespace fallback.
     *
     * @return string
     */
    protected static function getFactoryNamespace()
    {
        return 'Payavel\\Serviceable\\Database\\Factories';
    }
}
