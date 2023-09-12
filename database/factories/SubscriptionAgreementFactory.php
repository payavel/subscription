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
     * The name of the factory's corresponding model.
     *
     * @return string
     */
    public function modelName()
    {
        return SubscriptionAgreement::class;
    }

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
            if (is_null($subscriptionAgreement->plan_id)) {
                $subscriptionPlan = SubscriptionPlan::inRandomOrder()->firstOr(function () {
                    return SubscriptionPlan::factory()->create();
                });

                $subscriptionAgreement->plan_id = $subscriptionPlan->id;
            }

            if (is_null($subscriptionAgreement->next_billing_date)) {
                $nextBillingDate = $subscriptionAgreement->start_date;

                while ($nextBillingDate->isBefore(today()->endOfDay())) {
                    $nextBillingDate->add($subscriptionAgreement->plan->renewPeriod->frequency, $subscriptionAgreement->plan->renewPeriod->unit);
                }

                $subscriptionAgreement->next_billing_date = $nextBillingDate;
            }
        });
    }
}
