<?php

namespace LinkAcademy\Gadgets\Commons\Support\Facades;

use LinkAcademy\Gadgets\Commons\Cart as Basket;

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
