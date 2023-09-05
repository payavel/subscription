<?php

namespace Payavel\Subscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Payavel\Serviceable\Traits\ServesConfig;
use Payavel\Subscription\Models\SubscriptionProduct;

class SubscriptionProductFactory extends Factory
{
    use ServesConfig;

    /**
     * The name of the factory's corresponding model.
     *
     * @return string
     */
    public function modelName()
    {
        return $this->config(
            'subscription',
            'models.' . SubscriptionProduct::class,
            SubscriptionProduct::class
        );
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
        ];
    }
}
