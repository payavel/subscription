<?php

namespace Payavel\Subscription;

class SubscriptionStatus
{
    const REQUEST_SUCCESS = 200;
    const REQUEST_FAILED = 400;
    const REQUEST_INVALID = 422;
    const REQUEST_ERROR = 500;

    const ACTIVE_AUTO_RENEW_ON = 20;
    const ACTIVE_AUTO_RENEW_OFF = 21;
    const ACTIVE_NO_PAYMENT_METHOD = 22;
    const PAUSED = 23;
    const EXPIRED = 24;
    const SUSPENDED = 30;
    const CANCELED_CUSTOMER = 31;
    const CANCELED_NO_PAYMENT = 32;

    /**
     * List of all supported subscription response codes.
     *
     * @var array
     */
    public static $codes = [
        self::REQUEST_SUCCESS => 'Success',
        self::REQUEST_FAILED => 'Request failed',
        self::REQUEST_INVALID => 'Invalid request',
        self::REQUEST_ERROR => 'Error',

        self::ACTIVE_AUTO_RENEW_ON => 'Active with auto renewal',
        self::ACTIVE_AUTO_RENEW_OFF => 'Active without auto renewal',
        self::ACTIVE_NO_PAYMENT_METHOD => 'Active without payment method',
        self::PAUSED => 'Paused',
        self::EXPIRED => 'Expired',
        self::SUSPENDED => 'Suspended',
        self::CANCELED_CUSTOMER => 'Customer canceled',
        self::CANCELED_NO_PAYMENT => 'Canceled due to non payment',
    ];

    /**
     * List of all supported subscription response code messages.
     *
     * @var array
     */
    public static $messages = [
        self::REQUEST_SUCCESS => 'The request was successful.',
        self::REQUEST_FAILED => 'The request failed.',
        self::REQUEST_INVALID => 'The request is invalid.',
        self::REQUEST_ERROR => 'The request resulted in error.',

        self::ACTIVE_AUTO_RENEW_ON => 'The subscription is active & will auto renew.',
        self::ACTIVE_AUTO_RENEW_OFF => 'The subscription is active & will not auto renew.',
        self::ACTIVE_NO_PAYMENT_METHOD => 'The subscription is active & is set to auto renew but doesn\'t have a payment method.',
        self::PAUSED => 'The subscription was paused.',
        self::EXPIRED => 'The subscription has reached it\'s end term & has expired.',
        self::SUSPENDED => 'The subscription was suspended due to non payment & is currently in grace period.',
        self::CANCELED_CUSTOMER => 'The subscription was canceled by the customer.',
        self::CANCELED_NO_PAYMENT => 'The subscription was canceled due to non payment & has reached the end of it\'s grace period.',
    ];

    /**
     * Get the definition of the provided code.
     *
     * @param int $status
     * @return string|null
     */
    public static function get($status)
    {
        return self::$codes[$status] ?? null;
    }

    /**
     * Get the description of the provided code.
     *
     * @param int $status
     * @return string|null
     */
    public static function getMessage($status)
    {
        return self::$messages[$status] ?? null;
    }
}
