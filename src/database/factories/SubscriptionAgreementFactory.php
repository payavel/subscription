<?php

namespace Payavel\Subscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Payavel\Subscription\Models\SubscriptionPlan;
use Payavel\Checkout\Models\PaymentMethod;

class SubscriptionAgreementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reference' => $this->faker->uuid(),
            'subscription_plan_id' => SubscriptionPlan::factory()->create()->id,
            'primary_payment_method_id' => PaymentMethod::factory()->create()->id,
            'backup_payment_method_id' => PaymentMethod::factory()->create()->id,
            'start_date' => $this->faker->date(),
            'next_billing_date' => $this->faker->date(),
            'status' => $this->faker->randomElement([0, 1, 2]),
        ];
    }
}
