<?php

namespace Payavel\Subscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Payavel\Subscription\Models\SubscriptionPeriod;

class SubscriptionPeriodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unit' => $this->faker->randomElement(SubscriptionPeriod::$units),
            'frequency' => $this->getFrequency($unit),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (SubscriptionPeriod $subscriptionPeriod) {
            if (is_null($subscriptionPeriod->frequency)) {
                $subscriptionPeriod->frequency = $this->faker->randomElement($this->getFrequency($subscriptionPeriod->unit));
            }
        });
    }

    private function getFrequency($unit)
    {
        return [
            'days' => range(1, 365),
            'weeks' => range(1, 52),
            'months' => range(1, 12),
            'years' => range(1, 3),
        ][$unit] ?? [1];
    }
}
