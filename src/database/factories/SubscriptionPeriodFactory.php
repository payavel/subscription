<?php

namespace Payavel\Subscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Payavel\Subscription\Models\SubscriptionPeriod;

class SubscriptionPeriodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @return string
     */
    public function modelName()
    {
        return SubscriptionPeriod::class;
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unit' => $unit = $this->faker->randomElement(SubscriptionPeriod::$units),
            'frequency' => $this->faker->randomElement($this->getFrequencies($unit)),
        ];
    }

    private function getFrequencies($unit)
    {
        return [
            'days' => range(1, 365),
            'weeks' => range(1, 52),
            'months' => range(1, 12),
            'years' => range(1, 3),
        ][$unit] ?? [1];
    }
}
