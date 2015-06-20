<?php namespace Maherelgamil\Arabicdatetime\Facades;

use Illuminate\Support\Facades\Facade;
use Maherelgamil\Arabicdatetime\Arabicdatetime;

class ArabicdatetimeFacade extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Arabicdatetime::class ;
    }
}