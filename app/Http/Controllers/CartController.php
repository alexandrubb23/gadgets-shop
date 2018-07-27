<?php declare(strict_types=1);

namespace LinkAcademy\Gadgets\Commons\Http\Controllers;

use LinkAcademy\Gadgets\Commons\Support\Facades\Cart;

class CartController
{
    /**
     * get home page
     *
     * @return void
     */
    public function index()
    {
        var_dump(Cart::getAll());
        return view('checkout.html');
    }
}