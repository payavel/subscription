<?php

namespace Payavel\Subscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
        $studlyName = Str::studly($name = $this->faker->word());

        return [
            'name' => $name,
            'request_class' => "App\\Services\\Subscription\\{$studlyName}SubscriptionRequest",
            'response_class' => "App\\Services\\Subscription\\{$studlyName}SubscriptionResponse",
        ];
    }
}
