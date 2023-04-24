<?php

namespace Payavel\Subscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Payavel\Subscription\Models\Subscription;
use Payavel\Subscription\Models\SubscriptionCustomer;
use Payavel\Subscription\Models\SubscriptionProduct;
use Payavel\Subscription\SubscriptionStatus;

class SubscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @return string
     */
    public function modelName()
    {
        return config('subscription.models.' . Subscription::class, Subscription::class);
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => SubscriptionCustomer::factory()->create()->id,
            'reference' => $this->faker->uuid(),
            'status' => $this->faker->randomElement([
                SubscriptionStatus::ACTIVE_AUTO_RENEW_ON,
                SubscriptionStatus::ACTIVE_AUTO_RENEW_OFF,
            ]),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Subscription $subscription) {
            if (is_null($subscription->product_id)) {
                $subscriptionProduct = SubscriptionProduct::inRandomOrder()->firstOr(function () {
                    return SubscriptionProduct::factory()->create();
                });

                $subscription->product_id = $subscriptionProduct->id;
            }
        });
    }
}
