<?php

namespace Payavel\Subscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Payavel\Subscription\Models\SubscriptionPlan;
use Payavel\Checkout\Models\PaymentMethod;
use Payavel\Subscription\Models\SubscriptionAgreement;
use Payavel\Subscription\SubscriptionStatus;

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
            'primary_payment_method_id' => PaymentMethod::factory()->create()->id,
            'start_date' => $this->faker->date(),
            'next_billing_date' => $this->faker->date(),
            'status' => $this->faker->randomElement([
                SubscriptionStatus::ACTIVE_AUTO_RENEW_ON,
                SubscriptionStatus::ACTIVE_AUTO_RENEW_OFF,
            ]),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (SubscriptionAgreement $subscriptionAgreement) {
            if (is_null($subscriptionAgreement->subscription_plan_id)) {
                $subscriptionPlan = SubscriptionPlan::inRandomOrder()->firstOr(function () {
                    return SubscriptionPlan::factory()->create();
                });

                $subscriptionAgreement->subscription_plan_id = $subscriptionPlan->id;
            }
        });
    }
}
