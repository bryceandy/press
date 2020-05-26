<?php

namespace Bryceandy\Press\Tests;

use Bryceandy\Press\PressBaseServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            PressBaseServiceProvider::class,
        ];
    }
}