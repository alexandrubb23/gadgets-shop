<?php

namespace AlxCart\Support;

defined('APP_DIR') or die('No script kiddies please!');

use AlxCart\Routing\Route as Controller;

class Route extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Controller::class;
    }
}
