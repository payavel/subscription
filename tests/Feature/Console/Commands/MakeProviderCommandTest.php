<?php

namespace Payavel\Subscription\Tests\Feature\Console\Commands;

use Payavel\Serviceable\Service;
use Payavel\Serviceable\Tests\Traits\AssertsGatewayExists;
use Payavel\Serviceable\Tests\Traits\CreatesServiceables;
use Payavel\Subscription\Tests\TestCase;

class MakeProviderCommandTest extends TestCase
{
    use AssertsGatewayExists,
        CreatesServiceables;

    /** @test */
    public function make_provider_command_defaults_to_subscription_service()
    {
        $provider = $this->createProvider(Service::find('subscription'));

        $this->artisan('subscription:provider', [
            'provider' => $provider->getId(),
        ])
            ->expectsOutput("{$provider->getName()} subscription gateway generated successfully!")
            ->assertExitCode(0);

        $this->assertGatewayExists($provider);
    }
}
