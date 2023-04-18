<?php

namespace Payavel\Subscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'frequency' => $this->faker->numberBetween(1, 30),
            'unit' => $this->faker->randomElement(['days', 'weeks', 'months', 'years']),
        ];
    }
}
