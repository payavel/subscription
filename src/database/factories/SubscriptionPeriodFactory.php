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
        'day',
        'week',
        'month',
        'year',
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
            'day' => range(1, 365),
            'week' => range(1, 52),
            'month' => range(1, 12),
            'year' => range(1, 3),
        ][$unit] ?? 1;
    }
}
