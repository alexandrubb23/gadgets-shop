<?php

namespace LinkAcademy\Gadgets\Commons\Support\Facades;

use LinkAcademy\Gadgets\Commons\Twig;

class View extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Twig::class;
    }
}
