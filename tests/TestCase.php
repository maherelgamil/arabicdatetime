<?php

namespace Maherelgamil\Arabicdatetime\Tests;

use Maherelgamil\Arabicdatetime\ArabicdatetimeServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [ArabicdatetimeServiceProvider::class];
    }
}
