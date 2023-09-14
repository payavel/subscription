<?php

namespace Payavel\Subscription\Models;

use Illuminate\Database\Eloquent\Model;
use Payavel\Serviceable\Traits\HasFactory;

class SubscriptionPeriod extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];

    /**
     * Allowed units of measurement.
     *
     * @var array
     */
    public static $units = [
        'days',
        'weeks',
        'months',
        'years',
    ];

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
