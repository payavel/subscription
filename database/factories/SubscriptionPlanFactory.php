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
     * The name of the factory's corresponding model.
     *
     * @return string
     */
    public function modelName()
    {
        return SubscriptionPlan::class;
    }

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
                $subscriptionPlan->product_id = SubscriptionProduct::inRandomOrder()
                    ->firstOr(fn () => SubscriptionProduct::factory()->create())
                    ->id;
            }

            if (is_null($subscriptionPlan->renew_period_id)) {
                $subscriptionPlan->renew_period_id = SubscriptionPeriod::inRandomOrder()
                    ->firstOr(fn () => SubscriptionPeriod::factory()->create())
                    ->id;
            }
        });
    }
}
