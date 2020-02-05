<?php

namespace LinkAcademy\Gadgets\Commons\Support\Facades;

use LinkAcademy\Gadgets\Commons\Http\Route as RouteController;

class Route extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return RouteController::class;
    }
}
