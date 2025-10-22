<?php

namespace Shafiqruslan\BcpTesting\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Shafiqruslan\BcpTesting\BcpTestingServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            BcpTestingServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function defineRoutes($router): void
    {
        require __DIR__.'/../routes/api.php';
    }
}
