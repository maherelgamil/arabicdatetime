<?php

namespace Maherelgamil\Arabicdatetime\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return ['Maherelgamil\\Arabicdatetime\\ArabicdatetimeServiceProvider'];
    }
}
