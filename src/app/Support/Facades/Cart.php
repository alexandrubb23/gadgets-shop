<?php

namespace App\Support\Facades;

defined('APP_DIR') or die('No script kiddies please!');

use AlxCart\Support\Facade;
use App\Cart as Basket;

class Cart extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Basket::class;
    }
}
