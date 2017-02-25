<?php

namespace Castable\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [\Castable\CastableServiceProvider::class, \Orchestra\Database\ConsoleServiceProvider::class];
    }
}
