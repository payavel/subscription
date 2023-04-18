<?php

namespace Payavel\Subscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Payavel\Subscription\Models\SubscriptionPeriod;
use Payavel\Subscription\Models\SubscriptionProduct;

class SubscriptionPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subscription_product_id' => SubscriptionProduct::factory()->create()->id,
            'price' => $this->faker->numberBetween(100, 1000),
            'currency' => $this->faker->currencyCode(),
            'renew_period_id' => SubscriptionPeriod::factory()->create()->id,
            'grace_period_id' => $this->faker->boolean() ? SubscriptionPeriod::factory()->create()->id : null,
            'trial_period_id' => $this->faker->boolean() ? SubscriptionPeriod::factory()->create()->id : null,
            'status' => $this->faker->randomElement([0, 1, 2]),
        ];
    }
}
