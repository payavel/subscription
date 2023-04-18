<?php

namespace Payavel\Subscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Payavel\Subscription\Models\SubscriptionProvider;

class SubscriptionProviderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @return string
     */
    public function modelName()
    {
        return config('subscription.models.' . SubscriptionProvider::class, SubscriptionProvider::class);
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'request_class' => PayavelSubscriptionRequest::class,
            'response_class' => PayavelSubscriptionResponse::class,
        ];
    }
}
