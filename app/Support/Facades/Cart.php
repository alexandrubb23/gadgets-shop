<?php

namespace LinkAcademy\Gadgets\Commons\Support\Facades;

use LinkAcademy\Gadgets\Commons\ShoppingBasket;

class Cart extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ShoppingBasket::class;
    }
}
