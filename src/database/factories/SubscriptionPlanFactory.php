<?php

namespace Payavel\Subscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Payavel\Subscription\Models\SubscriptionPeriod;
use Payavel\Subscription\Models\SubscriptionPlan;
use Payavel\Subscription\Models\SubscriptionProduct;
use Payavel\Subscription\SubscriptionStatus;

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
            'price' => $this->faker->numberBetween(100, 1000),
            'currency' => $this->faker->currencyCode(),
            'renew_period_id' => SubscriptionPeriod::factory()->create()->id,
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
        return $this->afterMaking(function (SubscriptionPlan $subscriptionPlan) {
            if (is_null($subscriptionPlan->product_id)) {
                $subscriptionProduct = SubscriptionProduct::inRandomOrder()->firstOr(function () {
                    return SubscriptionProduct::factory()->create();
                });

                $subscriptionPlan->product_id = $subscriptionProduct->id;
            }
        });
    }
}
