<?php

namespace Payavel\Subscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Payavel\Subscription\Models\SubscriptionCustomer;
use Payavel\Subscription\Models\SubscriptionProvider;

class SubscriptionCustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @return string
     */
    public function modelName()
    {
        return config('subscription.models.' . SubscriptionCustomer::class, SubscriptionCustomer::class);
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
        return $this->afterMaking(function (SubscriptionCustomer $subscriptionCustomer) {
            if (is_null($subscriptionCustomer->provider_id)) {
                $subscriptionDriver = config('subscription.defaults.driver');

                if ($subscriptionDriver === 'config') {
                    $subscriptionProviderId = config('subscription.defaults.provider');
                } elseif ($subscriptionDriver === 'database') {
                    $subscriptionProviderId = SubscriptionProvider::inRandomOrder()->firstOr(function () {
                        return SubscriptionProvider::factory()->create();
                    })->id;
                }

                $subscriptionCustomer->provider_id = $subscriptionProviderId ?? SubscriptionProvider::factory()->make()->id;
            }
        });
    }
}
