<?php

namespace Bryceandy\Press\Tests;

use Bryceandy\Press\PressBaseServiceProvider;
use Illuminate\Foundation\Application;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__.'/../database/factories');
    }

    /**
     * @param Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            PressBaseServiceProvider::class,
        ];
    }

    /**
     * @param Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testdb');
        $app['config']->set('database.connections.testdb', [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);
    }
}