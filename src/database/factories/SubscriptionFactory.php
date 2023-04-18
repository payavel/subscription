<?php

namespace Payavel\Subscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Payavel\Subscription\Models\Subscription;
use Payavel\Subscription\Models\SubscriptionProduct;
use Payavel\Subscription\Models\SubscriptionProvider;

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
            'subscription_product_id' => SubscriptionProduct::factory()->create()->id,
            'provider_id' => SubscriptionProvider::factory()->create()->id,
            'reference' => $this->faker->uuid,
            'subscriber_id' => $this->faker->randomNumber(),
            'subscriber_type' => $this->faker->word,
            'status' => $this->faker->randomElement([0, 1, 2]),
        ];
    }
}
