<?php

namespace Payavel\Subscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Payavel\Serviceable\Models\Merchant;
use Payavel\Serviceable\Traits\ServesConfig;
use Payavel\Subscription\Models\SubscriptionAccount;
use Payavel\Serviceable\Models\Provider;

class SubscriptionAccountFactory extends Factory
{
    use ServesConfig;

    /**
     * The name of the factory's corresponding model.
     *
     * @return string
     */
    public function modelName()
    {
        return $this->config(
            'subscription',
            'models.' . SubscriptionAccount::class,
            SubscriptionAccount::class
        );
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'token' => $this->faker->uuid()
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (SubscriptionAccount $subscriptionAccount) {
            if (is_null($subscriptionAccount->provider_id)) {
                $provider = $this->config(
                    'subscription',
                    'models.' . Provider::class,
                    Provider::class
                );

                $subscriptionAccount->provider_id = $provider::inRandomOrder()
                    ->firstOr(fn () => $provider::factory()->create())
                    ->id;
            }

            if (is_null($subscriptionAccount->merchant_id)) {
                $merchant = $this->config(
                    'subscription',
                    'models.' . Merchant::class,
                    Merchant::class
                );

                $subscriptionAccount->merchant_id = $merchant::inRandomOrder()
                    ->firstOr(fn () => $merchant::factory()->create())
                    ->id;
            }
        });
    }
}
