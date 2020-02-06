<?php declare(strict_types=1);

namespace LinkAcademy\Gadgets\Commons\Http\Controllers;

defined('APP_DIR') or die('No script kiddies please!');

use LinkAcademy\Gadgets\Commons\Support\Facades\Cart;

class ProductsController
{
    /**
     * All products.
     *
     * @return string
     */
    public function index(): void
    {
        view('store.html');
    }

    /**
     * Prodcut detail.
     *
     * @param  int    $id Product id
     * @return string
     */
    public function getProduct(int $id): void
    {
        Cart::addItem(1);
        Cart::addItem(2);
        //Cart::addItems([1, 2, 3, 4, 0, -1]);

        view('product.html', ['product_id' => $id]);
    }
}
