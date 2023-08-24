<?php

namespace Payavel\Subscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Payavel\Subscription\Models\SubscriptionAccount;
use Payavel\Serviceable\Models\Provider;

class SubscriptionAccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @return string
     */
    public function modelName()
    {
        return config('subscription.models.' . SubscriptionAccount::class, SubscriptionAccount::class);
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
            if (
                is_null($subscriptionAccount->provider_id) &&
                method_exists($this, $getProviderId = 'getProviderIdVia' . Str::studly(config('subscription.defaults.driver')))
            ) {
                $subscriptionAccount->provider_id = $this->{$getProviderId}();
            }
        });
    }

    protected function getProviderIdViaConfig()
    {
        return $this->faker->randomElement(array_keys(config('subscription.providers')));
    }

    protected function getProviderIdViaDatabase()
    {
        return Provider::inRandomOrder()->firstOr(function () {
            return Provider::factory()->create();
        })->id;
    }
}
