<?php

namespace Payavel\Subscription\Console\Commands;

use Payavel\Serviceable\Console\Commands\MakeProvider as Command;

class MakeProvider extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:provider
                            {provider? : The provider}
                            {--service=subscription}
                            {--fake : Generates a gateway to be used for testing purposes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold a new subscription provider\'s gateway and response classes.';
}
