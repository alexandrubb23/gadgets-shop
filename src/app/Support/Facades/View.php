<?php

namespace LinkAcademy\Gadgets\Commons\Support\Facades;

defined('APP_DIR') or die('No script kiddies please!');

use AlxCart\Support\Facade;
use LinkAcademy\Gadgets\Commons\View\Twig;

class View extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Twig::class;
    }
}
