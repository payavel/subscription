<?php

namespace Payavel\Subscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionPeriodFactory extends Factory
{
    /**
     * Possible units of measurement.
     *
     * @var array
     */
    private $units = [
        'days',
        'weeks',
        'months',
        'years',
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unit' => $unit = $this->faker->randomElement($this->units),
            'frequency' => $this->getFrequency($unit),
        ];
    }

    private function getFrequency($unit)
    {
        return [
            'days' => range(1, 365),
            'weeks' => range(1, 52),
            'months' => range(1, 12),
            'years' => range(1, 3),
        ][$unit] ?? 1;
    }
}
