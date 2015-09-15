<?php namespace Maherelgamil\Arabicdatetime\Facades;

use Illuminate\Support\Facades\Facade;

class Arabicdatetime extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'arabicdatetime';
    }
}