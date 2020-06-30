<?php

namespace Messerli90\UserCredit\Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as TestbenchTestCase;
use Messerli90\UserCredit\UserCreditServiceProvider;

class TestCase extends TestbenchTestCase
{
    // use RefreshDatabase;

    // use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate', [
            '--database' => 'testbench',
            '--realpath' => realpath(__DIR__ . '/../database/migrations'),
        ]);
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }


    protected function getPackageProviders($app)
    {
        return [UserCreditServiceProvider::class];
    }
}
