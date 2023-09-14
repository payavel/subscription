<?php

namespace Payavel\Subscription\Tests\Unit;

use Illuminate\Support\Facades\Config;
use Payavel\Subscription\Models\SubscriptionAccount;
use Payavel\Subscription\Tests\TestCase;
use Payavel\Subscription\Tests\User;

class SubscribableTraitTest extends TestCase
{
    /** @test */
    public function retrieve_subscribable_accounts()
    {
        $subscribableWithoutAccounts = User::factory()->create();

        $this->assertEmpty($subscribableWithoutAccounts->accounts);

        $subscribableWithAccounts = User::factory()->hasAccounts($count = $this->faker->numberBetween(1, 3))->create();

        $this->assertCount($count, $subscribableWithAccounts->accounts);

        $this->assertEquals(SubscriptionAccount::class, get_class($subscribableWithAccounts->accounts->first()));
    }

    /** @test */
    public function retrieve_custom_subscribable_accounts()
    {
        Config::set('subscription.models.' . SubscriptionAccount::class, CustomSubscriptionAccount::class);

        $subscribable = User::factory()->hasAccounts(1)->create();

        $this->assertEquals(CustomSubscriptionAccount::class, get_class($subscribable->accounts()->first()));
    }
}

class CustomSubscriptionAccount extends SubscriptionAccount
{
    protected $table = 'subscription_accounts';
}
