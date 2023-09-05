<?php

namespace Payavel\Subscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Payavel\Serviceable\Traits\ServesConfig;
use Payavel\Subscription\Models\Subscription;
use Payavel\Subscription\Models\SubscriptionAccount;
use Payavel\Subscription\Models\SubscriptionProduct;
use Payavel\Subscription\SubscriptionStatus;

class SubscriptionFactory extends Factory
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
            'models.' . Subscription::class,
            Subscription::class
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
            'account_id' => SubscriptionAccount::factory()->create()->id,
            'reference' => $this->faker->uuid(),
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
        return $this->afterMaking(function (Subscription $subscription) {
            if (is_null($subscription->account_id)) {
                $subscriptionAccount = $this->config(
                    'subscription',
                    'models.' . SubscriptionAccount::class,
                    SubscriptionAccount::class
                );

                $subscription->account_id = $subscriptionAccount::inRandomOrder()
                    ->firstOr(fn () => $subscriptionAccount::factory()->create())
                    ->id;
            }

            if (is_null($subscription->product_id)) {
                $subscriptionProduct = $this->config(
                    'subscription',
                    'models.' . SubscriptionProduct::class,
                    SubscriptionProduct::class
                );

                $subscription->product_id = $subscriptionProduct::inRandomOrder()
                    ->firstOr(fn () => $subscriptionProduct::factory()->create())
                    ->id;
            }
        });
    }
}
